@extends('layouts.app')

@section('moreCss')
    <link href="{{ URL::asset('css/account.css') }}" rel="stylesheet">
@endsection

@section('content')

    <a href={{'/home'}}>
        <div class="returnToHome">
            <
        </div>
    </a>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Joke

                        <div class="date-info">
                            {{ $users[Auth::user()->id - 1]->jokes[$jokePlace]->created_at }}
                        </div>

                    </div>

                    <div class="panel-body">
                        <div class="jokeTable">
                            <div class="jokeInfo-info">
                                <div class="content-info">
                                    {{ $users[Auth::user()->id - 1]->jokes[$jokePlace]->content }}
                                </div>
                                <div class="buttonsContainer-info">
                                    <div class="individualButtonContainer-info">
                                        <a href={{'/editJoke/'.$users[Auth::user()->id - 1]->jokes[$jokePlace]->id.'/'.$jokePlace}}>
                                            <div class="editButton-info">
                                                Edit
                                            </div>
                                        </a>
                                    </div>
                                    <div class="individualButtonContainer-info">
                                        <a href={{'/delete/'.$users[Auth::user()->id - 1]->jokes[$jokePlace]->id}}>
                                            <div class="deleteButton-info">
                                                Delete
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
