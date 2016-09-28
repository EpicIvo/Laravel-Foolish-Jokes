@extends('layouts.app')

@section('moreCss')
    <link href="{{ URL::asset('css/account.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Jokes</div>

                    <div class="panel-body">
                        <div class="jokeTable">
                            @for($i = 0; $i < count($users[Auth::user()->id - 1]->jokes); $i++)
                                <a href={{"/info/".$i}}>
                                <div class="jokeInfo">
                                    <div class="content">
                                        {{ $users[Auth::user()->id - 1]->jokes[$i]->content }}
                                    </div>
                                    <div class="date">
                                        {{ $users[Auth::user()->id - 1]->jokes[$i]->created_at }}
                                    </div>
                                </div>
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
