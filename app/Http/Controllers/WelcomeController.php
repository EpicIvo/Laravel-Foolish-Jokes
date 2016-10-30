<?php

namespace App\Http\Controllers;

use Auth;
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
        $jokes = DB::table('jokes')
            ->where('jokes.status', '=', 1)
            ->orderBy('id', 'DESC')
            ->get();
        $welcomeData = [
            'jokes' => $jokes,
            'users' => User::all(),
            'jokeLikes' => jokeLike::all()
        ];
        return view('welcome', compact('welcomeData'));
    }

    public function likedJokes($userId)
    {
        $jokes = DB::table('jokes')
            ->leftJoin('joke_likes', 'jokes.id', '=', 'joke_likes.joke_id')
            ->select('jokes.id', 'jokes.user_id', 'jokes.content')
            ->where('joke_likes.user_id', '=', $userId)
            ->get();
        $welcomeData = [
            'jokes' => $jokes,
            'users' => User::all(),
            'userId' => $userId,
            'jokeLikes' => jokeLike::all()
        ];
        return view('likedJokes', compact('welcomeData'));
    }

    //Like
    public function like()
    {
        $data = Request::capture()->all();

        $like = new jokeLike();
        $like->user_id = $data['userId'];
        $like->joke_id = $data['jokeId'];
        $like->save();

    }
}
