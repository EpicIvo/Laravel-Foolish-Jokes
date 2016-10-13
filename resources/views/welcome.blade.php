@extends('layout')
@section('header')

    <title>Foolish Jokes</title>
    <link href="{{ URL::asset('css/welcome.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ URL::asset('images/FJLOGO.png') }}">

@stop
@section('content')

    <div class="homePage">
        <div class="jokeContainer" id="jokeContainer">
            <div id='container' class="container">

                <div id='title' class="title">
                    <div class="titleText">
                        Foolish Jokes
                        <div class='betaText'><i>Development phase</i></div>
                    </div>
                </div>

                <div class="likeImageContainer" id="likeImageContainer">
                    <img class="likeImage" id="likeImage" src="{{ URL::asset('images/graylike.png') }}"/>
                </div>

                <div id="joke" class="joke">
                </div>

            </div>

            <div class="downImageContainer" id="downImageContainer">
                <img class='downImage' id="downImage" src="{{ URL::asset('images/arrow.png') }}">
            </div>

        </div>
        <div class="uploadContainer" id="uploadContainer">
            @if(Auth::user())
                <div class="buttonsContainer">
                    <a href="{{ URL::to('login') }}">
                        <div class="accountsButton">
                            My account
                        </div>
                    </a>
                </div>
            @else
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
            @endif
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
                @if(Auth::user())
        var loggedIn = true;
        var loggedInUserId = {!!Auth::user()->id!!};
                @else
        var loggedIn = false;
        @endif

        //JSON
        var jokeData = {!! json_encode($welcomeData['jokes']->toArray()) !!};
        var usersData = {!! json_encode($welcomeData['users']->toArray()) !!};
        var jokeLikesNumber = {!! json_encode($welcomeData['jokeLikes']->toArray()) !!};

        //Logging the data
        console.log(jokeData);
        console.log(usersData);
        console.log(jokeLikesNumber);

        //divs in the joke
        var container = document.getElementById('container');
        var jokeContent = document.createElement('div');
        var jokeAuthor = document.createElement('div');
        var jokeLikes = document.createElement('div');
        var alreadyLiked = document.createElement('div');
        var likeCounter = 0;
        var likeImage = document.getElementById('likeImage');
        var joke = document.getElementById('joke');


        function processData() {

            likeCounter = 0;

            var userId = jokeData[jokeNumber].user_id - 1;

            for (var i = 0; i < jokeLikesNumber.length; i++) {

                if (jokeLikesNumber[i].joke_id === jokeData[jokeNumber].id) {
                    likeCounter++;
                } else {
                }

            }

            for (var j = 0; j < jokeLikesNumber.length; j++) {
                if (jokeLikesNumber[j].user_id === 2) {
                } else {
                }
            }

            jokeContent.setAttribute('id', 'jokeContent');
            jokeContent.setAttribute('class', 'jokeContent');
            jokeContent.innerHTML = jokeData[jokeNumber].content;

            jokeAuthor.setAttribute('id', 'jokeAuthor');
            jokeAuthor.setAttribute('class', 'jokeAuthor');
            jokeAuthor.innerHTML = usersData[userId].name;

            jokeLikes.setAttribute('id', 'jokeLikes');
            jokeLikes.setAttribute('class', 'jokeLikes');
            jokeLikes.innerHTML = likeCounter;

            alreadyLiked.setAttribute('id', 'alreadyLiked');
            alreadyLiked.setAttribute('class', 'alreadyLiked');
            alreadyLiked.innerHTML = 'Already liked';

            joke.appendChild(jokeContent);
            joke.appendChild(jokeAuthor);
            joke.appendChild(jokeLikes);
            container.appendChild(alreadyLiked);

            //calc margin
            calcMargin();
        }

        joke.addEventListener('click', clickDetected);

        function clickDetected() {
            joke.removeEventListener('click', clickDetected);
            joke.addEventListener('click', secondClickDetected);
            jokeContent.style.transform = 'scale(1.5)';
            setTimeout(jokeSmallAnimation, 700);
        }

        function secondClickDetected() {
            console.log('secondClick');
            var likeable = true;
                    @if(Auth::user())
            for (var k = 0; k < jokeLikesNumber.length; k++) {
                if (jokeLikesNumber[k]['user_id'] == loggedInUserId && jokeLikesNumber[k]['joke_id'] == jokeData[jokeNumber].id) {
                    console.log('cant like');
                    likeable = false;
                }
            }
            @endif
            if (likeable) {
                if (loggedIn) {
                    console.log(jokeLikesNumber[jokeNumber]);
                    jokeLikes.innerHTML = likeCounter + 1;
                    likeAnimation();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: '/like',
                        dataType: 'JSON',
                        data: {jokeId: jokeData[jokeNumber].id, userId: loggedInUserId},
                        success: function (data) {
                            console.log("ajax request succes" + data);
                        }
                    });
                } else {
                    window.location = "http://homestead.app/login";
                }
            } else {
                console.log('no like happend');
                alreadyLiked.style.display = 'block';
                alreadyLiked.style.opacity = '1';
                likeable = true;
            }
            joke.removeEventListener('click', secondClickDetected);
        }
        function likeAnimation() {
            likeImage.style.transform = 'scale(40)';
            likeImage.style.opacity = '0';
            setTimeout(likeImageSmall, 1000);
        }

        function likeImageSmall() {
            likeImage.style.transition = '0s';
            likeImage.style.transform = 'scale(0)';
            setTimeout(likeImageOpacity, 1200);
        }

        function likeImageOpacity() {
            likeImage.style.opacity = '1';
            likeImage.style.transition = 'transform 2s, opacity 2s';
        }

        function jokeSmallAnimation() {
            joke.removeEventListener('click', secondClickDetected);
            jokeNumber++;
            jokeContent.style.transform = 'scale(0)';
            jokeAuthor.style.transform = 'scale(0)';
            jokeLikes.style.transform = 'scale(0)';
            setTimeout(jokeBigAnimation, 1000);
        }

        function jokeBigAnimation() {
            processData();
            jokeContent.style.transform = 'scale(1)';
            jokeAuthor.style.transform = 'scale(1)';
            jokeLikes.style.transform = 'scale(1)';
            setTimeout(restoreListener, 1200);
            alreadyLiked.style.display = 'none';
            alreadyLiked.style.opacity = '0';
        }

        function restoreListener() {
            joke.addEventListener('click', clickDetected);
        }

    </script>
    <script src="{{ URL::asset('js/homeStyle.js') }}" type="text/javascript">
    </script>
    <script src="{{ URL::asset('js/jquery-3.1.1.min.js') }}" type="text/javascript">
    </script>
@stop
