@extends('layouts.app')

@section('moreCss')
    <link href="{{ URL::asset('css/account.css') }}" rel="stylesheet">
@endsection

@section('content')

    <a href="{{ URL::to('new') }}">
        <div class="newJokeButton">
            New Joke
        </div>
    </a>

    <div class="container">
        <div class="row">
            <div class="col-md-20 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Jokes</div>

                    <div class="panel-body">
                        <div class="jokeTable">
                            @for($i = 0; $i < count($users[Auth::user()->id - 1]->jokes); $i++)
                                <div class="jokeInfo">
                                    <a href={{"/info/".$i}}>
                                        <div class="content">
                                            {{ $users[Auth::user()->id - 1]->jokes[$i]->content }}
                                        </div>
                                    </a>
                                    <div class="stateSwitchButton" id="stateSwitchButton{{$i}}" title="{{$i}}">
                                        Active
                                    </div>
                                    <div class="date">
                                        {{ $users[Auth::user()->id - 1]->jokes[$i]->created_at }}
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/jquery-3.1.1.min.js') }}" type="text/javascript">
    </script>
    <script type="text/javascript">

                @for($i = 0; $i < count($users[Auth::user()->id - 1]->jokes); $i++)
        var stateSwitchButton = document.getElementById('stateSwitchButton{{$i}}');
        stateSwitchButton.addEventListener('click', function changeState(e) {
            ajaxRequest(e.target.title);
        });
        @endfor

        function ajaxRequest(targetJokeId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/changeState',
                dataType: 'JSON',
                data: {jokeId: targetJokeId},
                success: function (data) {
                    console.log("ajax request succes" + data);
                }
            });
        }
    </script>
@endsection
