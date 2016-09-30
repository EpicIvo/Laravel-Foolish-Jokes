<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Joke;
use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //Index
    public function index()
    {
        $users = User::all();
        $jokes = Joke::all();
        return view('welcome', compact('jokes'), compact('users'));
    }

    //Like
    public function like()
    {
        $data = Request::capture()->all();

//        echo $data['jokeId'];
//        echo $data['jokeLikes'];

        $time = Carbon::now();
        $joke = Joke::find($data['jokeId']);

        if ($joke) {
            $joke->likes = $data['jokeLikes'];
            $joke->updated_at = $time->toDateTimeString();
            $joke->save();
        } else {
            echo "not working :'(" . $joke;
        }
    }
}
