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
                            @for($i = 0; $i < count($users[0]->jokes); $i++)
                                <div class="jokeInfo">
                                    <div class="content">
                                        {{ $users[0]->jokes[$i]->content }}
                                    </div>
                                    <div class="date">
                                        {{ $users[0]->jokes[$i]->created_at }}
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
