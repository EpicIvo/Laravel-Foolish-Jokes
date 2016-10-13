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
//Auth
Auth::routes();


//Index
Route::get('/', 'WelcomeController@index');

//Index logged in
Route::get('/likedJokes/{userId}', 'WelcomeController@likedJokes');

//Like
Route::post('/like', 'WelcomeController@like');

//Search
Route::post('/search', 'HomeController@search');


//Account
Route::get('/home', 'HomeController@index');

//Joke info
Route::get('/info/{jokePlace}', 'HomeController@jokeInfo');

//New
Route::get('/new', 'HomeController@newJoke');
Route::post('/create', 'HomeController@create');

//Edit
Route::get('/editPage/{jokeId}', 'HomeController@editPage');
Route::put('/edit/{jokeId}', 'HomeController@edit');

Route::get('/edit/{jokeId}', 'HomeController@editJoke');
Route::get('/delete/{jokeId}', 'HomeController@deleteJoke');

//changeState
Route::post('/changeState', 'HomeController@changeState');


//ADMIN
//all jokes
Route::get('/allJokes', 'AdminController@allJokes');

//joke info
Route::get('/adminInfo/{jokeId}', 'AdminController@adminInfo');

//edit joke
Route::get('/adminEditPage/{jokeId}', 'AdminController@adminEditPage');
Route::put('/adminEdit/{jokeId}', 'AdminController@adminEdit');

Route::get('/adminDelete/{jokeId}', 'AdminController@adminDeleteJoke');
