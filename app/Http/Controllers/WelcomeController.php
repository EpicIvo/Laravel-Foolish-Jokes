<?php

namespace App\Http\Controllers;

use App\Joke;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class WelcomeController extends Controller
{
    public function index() {

        $users = User::all();
        return view('welcome')->with('users', $users);

    }
}
