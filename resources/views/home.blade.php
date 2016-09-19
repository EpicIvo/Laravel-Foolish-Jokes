@extends('layout')
@section('header')

    <title>Foolish Jokes</title>
    <link href="{{ URL::asset('css/home.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ URL::asset('images/FJLOGO.png') }}">

@stop
@section('content')

    <div class="pageContainer">
        <div id='container' class="container">

            <div id='title' class="title">
                Foolish Jokes
                <div class='betaText'><i>Development phase</i></div>
            </div>

            <div id="joke" class="joke">
                <div class="jokeContent">
                    {{ $jokes[0]->content }}
                </div>
                <div class="jokeAuthor">
                    {{ $jokes[0]->author }}
                </div>

            </div>

        </div>

    </div>

    <script src="{{ URL::asset('js/homeStyle.js') }}" type="text/javascript">
    </script>

@stop

