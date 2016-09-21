<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\Joke;

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/info/{jokeId}', 'HomeController@jokeInfo');

Route::get('/edit/{jokeId}', 'HomeController@editJoke');
Route::get('/delete/{jokeId}', 'HomeController@deleteJoke');
