<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function home(){

        $users = DB::table('users')->get();

        return view('welcome', compact('users'));
    }
}
