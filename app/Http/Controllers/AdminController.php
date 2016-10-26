<?php

namespace App\Http\Controllers;

use Redirect;
use Carbon\Carbon;
use App\User;
use App\Joke;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class AdminController extends Controller
{
    //Index
    public function allJokes()
    {
        $jokes = Joke::paginate(10);
        return view('account/admin/allJokes', compact('jokes'));
    }

    //Info
    public function adminInfo($jokeId)
    {
        $joke = Joke::all()->find($jokeId);
        return view('account/admin/adminInfo', compact('joke'));
    }

    //Edit
    public function adminEditPage($jokeId)
    {
        $joke = Joke::all()->find($jokeId);
        return view('account/admin/adminEdit', compact('joke'));
    }

    public function adminEdit($jokeId)
    {
        $time = Carbon::now();
        $joke = Joke::find($jokeId);

        if ($joke) {
            $joke->content = Input::get('jokeContent');
            $joke->tag = Input::get('jokeTag');
            $joke->updated_at = $time->toDateTimeString();
            $joke->save();
            return Redirect::action('AdminController@allJokes');
        } else {
        }
    }

    public function adminDeleteJoke($jokeId)
    {
        $joke = Joke::find($jokeId);
        $joke->delete();
        return Redirect::action('AdminController@allJokes');
    }

    public function adminSearch()
    {
        $data = Request::capture()->all();
        $searchQuery = $data['textInput'];

        $selectInput = $data['selectInput'];

        if ($selectInput == '') {
            $jokes = DB::table('jokes')
                ->where('jokes.content', 'like', '%' . $searchQuery . '%')
                ->get();
        } else {
            $jokes = DB::table('jokes')
                ->where('jokes.content', 'like', '%' . $searchQuery . '%')
                ->where('jokes.tag', '=', $selectInput)
                ->get();
        }

        $viewData = [
            'searchQuery' => $searchQuery,
            'jokes' => $jokes,
            'searchInput' => $searchQuery,
            'selectInput' => $selectInput
        ];
        return $viewData;
    }
}
