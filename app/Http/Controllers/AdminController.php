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
        $jokes = Joke::all();
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
            $joke->updated_at = $time->toDateTimeString();
            $joke->save();
            return Redirect::action('AdminController@allJokes');
        } else {
            echo "not working :'(" . $joke;
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
        $searchQuery = $data['inputData'];
        $jokes = DB::table('jokes')
            ->where('jokes.content', 'like', '%' . $searchQuery . '%')
            ->get();

        $viewData = [
            'searchQuery' => $searchQuery,
            'jokes' => $jokes,
        ];
        return $viewData;
    }
}
