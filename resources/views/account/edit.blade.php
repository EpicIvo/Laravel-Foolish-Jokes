@extends('layouts.app')

@section('moreCss')
    <link href="{{ URL::asset('css/account.css') }}" rel="stylesheet">
@endsection

@section('content')

    <a href={{'/info/' . $joke->id}}>
        <div class="returnToHome">
            <
        </div>
    </a>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Joke</div>

                    <div class="panel-body">

                        {!! Form::model($joke, ['url' => '/edit/'.$joke->id, 'method' => 'put']) !!}
                        {{ Form::label('joke', 'Joke:') }}
                        {{ Form::textarea('jokeContent', $joke->content, ['class' => 'form-control', 'required'] ) }}

                        {{ Form::hidden('userId', Auth::user()->id) }}

                        {{ Form::submit('Edit Joke', ['class' => 'formSubmit']) }}
                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
