@extends('layouts.adminLayout')
@extends('layouts.app')

@section('moreCss')
    <link href="{{ URL::asset('css/account.css') }}" rel="stylesheet">
@endsection

@section('content')

    <a href={{'/adminInfo/' . $joke->id}}>
        <div class="returnToHome">
            <
        </div>
    </a>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Joke</div>

                    <div class="panel-body">

                        {!! Form::model($joke, ['url' => '/adminEdit/'.$joke->id, 'method' => 'put']) !!}
                        {{ Form::label('joke', 'Joke:') }}
                        {{ Form::textarea('jokeContent', $joke->content, ['class' => 'form-control', 'required'] ) }}

                        {{ Form::label('jokeTag', 'Tag:') }}<br>
                        {{ Form::select('jokeTag', ['Bar' => 'Bar', 'Appearance' => 'Apearance', 'Animal' => 'Animal', 'Money' => 'Money', 'Miscellaneous' => 'Miscellaneous'], null, ['class' => 'jokeTag', 'placeholder' => 'select', 'required']) }}
                        <br>

                        {{ Form::hidden('userId', $joke->user_id) }}

                        {{ Form::submit('Edit Joke', ['class' => 'formSubmit']) }}
                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
