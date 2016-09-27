<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


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
        return view('home', compact('users'));
    }

    public function jokeInfo($jokeId)
    {
        $users = User::all();
        return view('info', compact('users'), compact('jokeId'));
    }

    public function editJoke()
    {
        $users = User::all();
        return view('home', compact('users'));
    }

    public function deleteJoke()
    {
        $users = User::all();
        return view('home', compact('users'));
    }
}
