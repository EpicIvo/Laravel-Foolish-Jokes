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
Route::get('home', [
    'as' => 'home', 'uses' => 'HomeController@index'
]);

Route::get('/info/{jokePlace}', 'HomeController@jokeInfo');

//New
Route::get('/new', 'HomeController@newJoke');
Route::post('/create', 'HomeController@create');
//Edit
Route::get('/editJoke/{jokeId}/{jokePlace}', 'HomeController@editJoke');
Route::put('/edit/{jokeId}', 'HomeController@edit');

Route::get('/edit/{jokeId}', 'HomeController@editJoke');
Route::get('/delete/{jokeId}', 'HomeController@deleteJoke');
