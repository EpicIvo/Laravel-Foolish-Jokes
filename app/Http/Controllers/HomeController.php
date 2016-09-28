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

    public function newJoke()
    {
        return view('account/new');
    }

    public function jokeInfo($jokeId)
    {
        $users = User::all();
        return view('account/info', compact('users'), compact('jokeId'));
    }

    public function editJoke()
    {
        $users = User::all();
        return view('account/home', compact('users'));
    }

    public function deleteJoke()
    {
        $users = User::all();
        return view('account/home', compact('users'));
    }

    public function create(){

        $time = Carbon::now();
        $joke = new Joke;

        $joke->user_id = Input::get('userId');
        $joke->content = Input::get('jokeContent');
        $joke->created_at = $time->toDateTimeString();
        $joke->save();

        return Redirect::action('HomeController@index');
    }
}
