@extends('layout')
@section('header')

    <title>Foolish Jokes</title>
    <link href="{{ URL::asset('css/home.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ URL::asset('images/FJLOGO.png') }}">

@stop
@section('content')
    <div class="homePage">
        <div class="jokeContainer" id="jokeContainer">
            <div id='container' class="container">

                <div id='title' class="title">
                    Foolish Jokes
                    <div class='betaText'><i>Development phase</i></div>
                </div>

                <div id="joke" class="joke">
                    <div class="jokeContent">
                        @for ($j = 0; $j < count($users); $j++)
                            @for($k = 0; $k < count($users[$j]->jokes); $k++)
                                {{ $users[$j]->jokes[$k]->content }}
                            @endfor
                            </div>
                                <div class="jokeAuthor">
                                {{$users[$j]->name}}
                            </div>
                        @endfor
                </div>

            </div>

            <div class="downImageContainer" id="downImageContainer">
                <img class='downImage' id="downImage" src="{{ URL::asset('images/arrow.png') }}">
            </div>

        </div>
        <div class="uploadContainer" id="uploadContainer">

            <div class="buttonsContainer">
                <a href="/login">
                    <div class="button">
                        Login
                    </div>
                </a>
                <a href="/register">
                    <div class="button">
                        Register
                    </div>
                </a>
            </div>

        </div>
    </div>
    <script src="{{ URL::asset('js/homeStyle.js') }}" type="text/javascript">
    </script>

@stop

