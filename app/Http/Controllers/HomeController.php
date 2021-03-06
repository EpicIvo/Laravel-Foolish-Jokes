<?php

namespace App\Http\Controllers;

use DB;
use Redirect;
use Carbon\Carbon;
use App\User;
use App\Joke;
use App\jokeLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    //Index
    public function index()
    {
        $users = User::all();
        return view('account/home', compact('users'));
    }

    //New Joke
    public function newJoke($userId)
    {
        $joke = Joke::all();
        $jokeLike = jokeLike::all()->where('user_id', '=', $userId);
        $fiveLikes = false;

        if (count($jokeLike) > 4) {
            $fiveLikes = true;
        }
        $newJokeViewData = [
            'joke' => $joke,
            'jokeLike' => $jokeLike,
            'fiveLikes' => $fiveLikes
        ];

        return view('account/new', compact('newJokeViewData'));
    }

    public function create()
    {
        $time = Carbon::now();
        $joke = new Joke;

        $joke->user_id = Input::get('userId');
        $joke->content = Input::get('jokeContent');
        $joke->tag = Input::get('jokeTag');
        $joke->created_at = $time->toDateTimeString();
        $joke->save();

        return Redirect::action('HomeController@index');
    }

    //Joke Info
    public function jokeInfo($jokeId)
    {
        $joke = Joke::all()->find($jokeId);
        return view('account/info', compact('joke'));
    }

    //Edit Joke
    public function editPage($jokeId)
    {
        $joke = Joke::all()->find($jokeId);
        return view('account/edit', compact('joke'));
    }

    public function edit($jokeId)
    {

        $time = Carbon::now();
        $joke = Joke::find($jokeId);

        if ($joke) {
            $joke->content = Input::get('jokeContent');

            $joke->updated_at = $time->toDateTimeString();
            $joke->save();
            return Redirect::action('HomeController@index');
        } else {
            echo "not working :'(" . $joke;
        }
    }

    public function deleteJoke($jokeId)
    {
        $joke = Joke::find($jokeId);
        $joke->delete();
        return Redirect::action('HomeController@index');
    }

    public function changeState()
    {
        $data = Request::capture()->all();
        $joke = Joke::find($data['jokeId']);

        echo $data['jokeId'];

        if ($joke) {
            if ($joke->status == 1) {
                $joke->status = 0;
            } else {
                $joke->status = 1;
            }
            $joke->save();
            return Redirect::action('HomeController@index');
        } else {
            echo "not working :'(" . $joke;
        }
    }

    //Search

    public function search()
    {
        $data = Request::capture()->all();
        $searchQuery = $data['textInput'];
        $userId = $data['userId'];

        $selectInput = $data['selectInput'];

        if ($selectInput == '') {
            $jokes = DB::table('jokes')
                ->where('jokes.content', 'like', '%' . $searchQuery . '%')
                ->where('jokes.user_id', '=', $userId)
                ->get();
        } else {
            $jokes = DB::table('jokes')
                ->where('jokes.content', 'like', '%' . $searchQuery . '%')
                ->where('jokes.tag', '=', $selectInput)
                ->where('jokes.user_id', '=', $userId)
                ->get();
        }

        $viewData = [
            'searchQuery' => $searchQuery,
            'jokes' => $jokes,
        ];
        return $viewData;
    }

}
