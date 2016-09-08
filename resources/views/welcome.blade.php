@extends('layout')

@section('header')

    <title>Laravel</title>

@stop

@section('content')

    <div class="content">

        @foreach($users as $person)

            {{$person->name}}

        @endforeach

    </div>

@stop

