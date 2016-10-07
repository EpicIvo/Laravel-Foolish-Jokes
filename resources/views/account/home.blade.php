@extends('layouts.app')

@section('moreCss')
    <link href="{{ URL::asset('css/account.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="newJokeButtonContainer">
        @if(Auth::user()->role == 'admin')
            <a href="{{ URL::to('allJokes') }}">
                <div class="adminNewJokeButton">
                    All Jokes
                </div>
            </a>

            <a href="{{ URL::to('new') }}">
                <div class="adminNewJokeButton">
                    New Joke
                </div>
            </a>
        @else
            <a href="{{ URL::to('new') }}">
                <div class="newJokeButton">
                    New Joke
                </div>
            </a>
        @endif
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-20 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Jokes</div>

                    <div class="panel-body">
                        <div class="jokeTable">
                            @for($i = 0; $i < count($users[Auth::user()->id - 1]->jokes); $i++)
                                <div class="jokeInfo" id="jokeInfo">
                                    <a href={{"/info/" . $users[Auth::user()->id - 1]->jokes[$i]->id}}>
                                        <div class="content">
                                            {{ $users[Auth::user()->id - 1]->jokes[$i]->content }}
                                        </div>
                                    </a>
                                    @if($users[Auth::user()->id - 1]->jokes[$i]->status == 1)
                                        <div class="stateSwitchButtonA" id="stateSwitchButton{{$i}}" title="{{$users[Auth::user()->id - 1]->jokes[$i]->id}}">
                                            Active
                                        </div>
                                    @else
                                        <div class="stateSwitchButtonU" id="stateSwitchButton{{$i}}" title="{{$users[Auth::user()->id - 1]->jokes[$i]->id}}">
                                            Unactive
                                        </div>
                                    @endif
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
            changeDiv(e.target.id, e.target.title, e.target.className);
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

        function changeDiv(divId, divTitle, divClass) {

            if (divClass == 'stateSwitchButtonA') {
                var div = document.getElementById(divId);
                var parent = div.parentNode;

                parent.removeChild(div);

                var newDiv = document.createElement('div');
                newDiv.setAttribute('class', 'stateSwitchButtonU');
                newDiv.setAttribute('id', divId);
                newDiv.setAttribute('title', divTitle);
                newDiv.innerHTML = 'Unactive';
            } else {
                var div = document.getElementById(divId);
                var parent = div.parentNode;

                parent.removeChild(div);

                var newDiv = document.createElement('div');
                newDiv.setAttribute('class', 'stateSwitchButtonA');
                newDiv.setAttribute('id', divId);
                newDiv.setAttribute('title', divTitle);
                newDiv.innerHTML = 'Active';
            }
            parent.appendChild(newDiv);

            newDiv.addEventListener('click', function changeState(e) {
                ajaxRequest(e.target.title);
                changeDiv(e.target.id, e.target.title, e.target.className);
            });
        }
    </script>
@endsection
