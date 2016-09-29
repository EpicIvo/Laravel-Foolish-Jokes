<?php

namespace App\Http\Controllers;

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
        $users = User::all();
        return view('account/info', compact('users'), compact('jokeId'));
    }

    //Edit Joke
    public function editJoke($jokeId)
    {
        $data = [
            'users' => User::all(),
            'joke' => Joke::all(),
            'jokeId' => $jokeId
        ];
        return view('account/edit', compact('data'));
    }

    public function edit($jokeId)
    {

        $time = Carbon::now();
        $joke = Joke::find($jokeId + 1);
        echo $joke;
        $joke->content = Input::get('jokeContent');
        $joke->updated_at = $time->toDateTimeString();
        $joke->save();

        return Redirect::action('HomeController@index');
    }

    public function deleteJoke()
    {
        $users = User::all();
        return view('account/home', compact('users'));
    }

}
