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
                </div>

            </div>

            <div class="downImageContainer" id="downImageContainer">
                <img class='downImage' id="downImage" src="{{ URL::asset('images/arrow.png') }}">
            </div>

        </div>
        <div class="uploadContainer" id="uploadContainer">

            <div class="buttonsContainer">
                <a href="{{ URL::to('login') }}">
                    <div class="button">
                        Login
                    </div>
                </a>
                <a href="{{ URL::to('register') }}">
                    <div class="button">
                        Register
                    </div>
                </a>
            </div>

        </div>
    </div>
    {{-- JAVASCRIPT --}}
    <script type="text/javascript">
        window.addEventListener('load', init);

        function init() {
            processData();
        }
        //Misc
        var jokeNumber = 0;

        //JSON
        var jokeData = {!! json_encode($jokes->toArray()) !!};
        var usersData = {!! json_encode($users->toArray()) !!};
        // -1 because db starts at 1 and array at 0
        var userId = jokeData[jokeNumber].user_id - 1;

        //Logging the data
        console.log(jokeData);
        console.log(usersData);

        //divs in the joke
        var jokeContent = document.createElement('div');
        var jokeAuthor = document.createElement('div');
        //var jokeLikes = document.createElement('div');
        var joke = document.getElementById('joke');


        function processData() {

            jokeContent.setAttribute('id', 'jokeContent');
            jokeContent.setAttribute('class', 'jokeContent');
            jokeContent.innerHTML = jokeData[jokeNumber].content;

            jokeAuthor.setAttribute('id', 'jokeAuthor');
            jokeAuthor.setAttribute('class', 'jokeAuthor');
            jokeAuthor.innerHTML = usersData[userId].name;

            {{--jokeLikes.setAttribute('id', 'jokeLikes');--}}
            {{--jokeLikes.setAttribute('class', 'jokeLikes');--}}
            {{--jokeLikes.innerHTML ={!!  !!};--}}

            joke.appendChild(jokeContent);
            joke.appendChild(jokeAuthor);
            {{--joke.appendChild(jokeLikes);--}}

            //calc margin
            calcMargin();
        }

        joke.addEventListener('click', clickDetected);

        function clickDetected() {
            joke.removeEventListener('click', clickDetected);
            jokeNumber += 1;
            jokeContent.style.transform = 'scale(1.5)';
            setTimeout(jokeSmallAnimation, 700);
        }
        function jokeSmallAnimation() {
            jokeContent.style.transform = 'scale(0)';
            jokeAuthor.style.transform = 'scale(0)';
            setTimeout(jokeBigAnimation, 700);
        }
        function jokeBigAnimation() {
            processData();
            jokeContent.style.transform = 'scale(1)';
            jokeAuthor.style.transform = 'scale(1)';
            joke.addEventListener('click', clickDetected);
        }

    </script>
    <script src="{{ URL::asset('js/homeStyle.js') }}" type="text/javascript">
    </script>
@stop
