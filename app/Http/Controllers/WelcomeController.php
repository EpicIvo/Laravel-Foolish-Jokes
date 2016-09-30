<?php

namespace App\Http\Controllers;

use DB;
use App\jokeLike;
use Carbon\Carbon;
use App\Joke;
use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //Index
    public function index()
    {
        $welcomeData = [
            'jokes' => Joke::all(),
            'users' => User::all(),
            'jokeLikes' => jokeLike::all()
        ];
        return view('welcome', compact('welcomeData'));
    }

    //Like
    public function like()
    {
        $data = Request::capture()->all();
//        echo $data['jokeId'];
//        echo $data['userId'];

        $like = new jokeLike();
        $like->user_id = $data['userId'];
        $like->joke_id = $data['jokeId'];
        $like->save();

        echo $like;

    }
}
