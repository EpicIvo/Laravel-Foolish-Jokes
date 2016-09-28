<?php

namespace App\Http\Controllers;

use App\Joke;
use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $users = User::all();
        $jokes = Joke::all();
        return view('welcome', compact('jokes'), compact('users'));
    }
}
