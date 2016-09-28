@extends('layouts.app')

@section('moreCss')
    <link href="{{ URL::asset('css/account.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Joke</div>

                    <div class="panel-body">

                        {!! Form::open(['url' => '/create', 'method' => 'get']) !!}
                            {{ Form::label('joke', 'Joke:') }}
                            {{ Form::textarea('jokeContent', null, ['class' => 'form-control', 'required'] ) }}

                            {{ Form::hidden('userId', Auth::user()->id) }}

                            {{ Form::submit('Place Joke', ['class' => 'formSubmit']) }}
                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
