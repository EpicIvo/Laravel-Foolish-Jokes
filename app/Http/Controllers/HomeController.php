<?php

namespace App\Http\Controllers;

use DB;
use Redirect;
use Carbon\Carbon;
use App\User;
use App\Joke;
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
    public function newJoke()
    {
        $joke = Joke::all();
        return view('account/new', compact('joke'));
    }

    public function create()
    {

        $time = Carbon::now();
        $joke = new Joke;

        $joke->user_id = Input::get('userId');
        $joke->content = Input::get('jokeContent');
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
        $searchQuery = $data['inputData'];
        $jokes = DB::table('jokes')
            ->where('jokes.content', 'like', '%' . $searchQuery . '%')
            ->get();

        $viewData = [
            'searchQuery' => $searchQuery,
            'jokes' => $jokes,
        ];
        return $viewData;
    }

}
