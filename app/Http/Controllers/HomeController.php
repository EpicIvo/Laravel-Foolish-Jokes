<?php

namespace App\Http\Controllers;

use App\Joke;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){

        $jokes = Joke::all();
        return view('home', compact('jokes'));
    }
}
