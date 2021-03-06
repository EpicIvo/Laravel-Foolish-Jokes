@extends('layouts.adminLayout')
@extends('layouts.app')

@section('moreCss')
    <link href="{{ URL::asset('css/account.css') }}" rel="stylesheet">
@endsection

@section('content')
    <a href="{{ URL::to('home') }}">
        <div class="newJokeButton">
            My Jokes
        </div>
    </a>

    <div class="container">
        <div class="row">
            <div class="col-md-20 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="yourJokesTitle">
                            Your Jokes
                        </div>

                        <div class="search">
                            {!! Form::model($jokes, ['url' => '/', 'method' => 'get', 'class' => 'searchForm', 'type' => 'button']) !!}
                            {{ Form::text('search', '', ['class' => 'searchFormInput', 'id' => 'textInput', 'placeholder' => 'Search']) }}
                            {{ Form::label('jokeTag', 'Tag:', ['class' => 'tagLabel']) }}
                            {{ Form::select('jokeTag', ['Bar' => 'Bar', 'Appearance' => 'Apearance', 'Animal' => 'Animal', 'Money' => 'Money', 'Miscellaneous' => 'Miscellaneous'], null, ['class' => 'searchJokeTag', 'id' => 'selectInput', 'placeholder' => 'All']) }}
                            {!! Form::close() !!}
                        </div>

                    </div>

                    <div class="panel-body">
                        <div id="jokeTable" class="jokeTable">
                            @for($i = 0; $i < count($jokes); $i++)
                                <div class="jokeInfo" id="jokeInfo">
                                    <div class="content">
                                        {{ substr($jokes[$i]->content, 0, 110) }}{{ strlen($jokes[$i]->content) > 110 ? "..." : "" }}
                                    </div>
                                    <div class="stateSwitchButtonContainer">
                                        @if($jokes[$i]->status == 1)
                                            <div class="stateSwitchButtonA" id="stateSwitchButton{{$i}}" title="{{$jokes[$i]->id}}">
                                                Active
                                            </div>
                                        @else
                                            <div class="stateSwitchButtonU" id="stateSwitchButton{{$i}}" title="{{$jokes[$i]->id}}">
                                                Unactive
                                            </div>
                                        @endif
                                    </div>
                                    <a href={{"/adminInfo/".$jokes[$i]->id}}>
                                        <div class="infoButtonContainer">
                                            <div class="infoButton">
                                                Info
                                            </div>
                                        </div>
                                    </a>
                                    <div class="date">
                                        {{ $jokes[$i]->created_at }}
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="links" id="links">
                            {{ $jokes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/jquery-3.1.1.min.js') }}" type="text/javascript">
    </script>
    <script type="text/javascript">
                @for($i = 0; $i < count($jokes); $i++)

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

        //      Search functionality

        window.addEventListener('input', function () {
                    var textInput = document.getElementById('textInput');
                    var selectInput = document.getElementById('selectInput');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: '/adminSearch',
                        dataType: 'JSON',
                        data: {textInput: textInput.value, selectInput: selectInput.value},
                        success: function (data) {
                            if (data.searchQuery === "" && data.selectInput === "") {
                                document.getElementById('links').style.display = "block";
                            } else {
                                document.getElementById('links').style.display = "none";
                                console.log(data);
                                $('#jokeTable').html('');
                                for (var i = 0; i < data.jokes.length; i++) {
                                    if (data.jokes[i].content.length > 110) {
                                        if (data.jokes[i].status == 1) {
                                            $('#jokeTable').append(
                                                    '<div class="jokeInfo" id="jokeInfo">' +
                                                    '<div class="content">' + data.jokes[i].content.substr(0, 110) + "..." +
                                                    '</div>' +
                                                    '<div class="stateSwitchButtonContainer">' +
                                                    '<div class="stateSwitchButtonA" id="stateSwitchButton' + i + '" title="' + data.jokes[i].id + '">' +
                                                    'Active' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '<a href="/info/' +
                                                    data.jokes[i].id +
                                                    '">' +
                                                    '<div class="infoButtonContainer">' +
                                                    '<div class="infoButtonS">' +
                                                    'Info' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '</a>' +
                                                    '<div class="date">' + data.jokes[i].created_at +
                                                    '</div>'
                                            );
                                        } else {
                                            $('#jokeTable').append(
                                                    '<div class="jokeInfo" id="jokeInfo">' +
                                                    '<div class="content">' + data.jokes[i].content.substr(0, 110) + "..." +
                                                    '</div>' +
                                                    '<div class="stateSwitchButtonContainer">' +
                                                    '<div class="stateSwitchButtonU" id="stateSwitchButton' + i + '" title="' + data.jokes[i].id + '">' +
                                                    'Unactive' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '<a href="/info/' +
                                                    data.jokes[i].id +
                                                    '">' +
                                                    '<div class="infoButtonContainer">' +
                                                    '<div class="infoButtonS">' +
                                                    'Info' +
                                                    '</div>' +
                                                    "</div>" +
                                                    '</a>' +
                                                    '<div class="date">' + data.jokes[i].created_at + '</div>'
                                            );
                                        }
                                    }else {
                                        if (data.jokes[i].status == 1) {
                                            $('#jokeTable').append(
                                                    '<div class="jokeInfo" id="jokeInfo">' +
                                                    '<div class="content">' + data.jokes[i].content +
                                                    '</div>' +
                                                    '<div class="stateSwitchButtonContainer">' +
                                                    '<div class="stateSwitchButtonA" id="stateSwitchButton' + i + '" title="' + data.jokes[i].id + '">' +
                                                    'Active' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '<a href="/info/' +
                                                    data.jokes[i].id +
                                                    '">' +
                                                    '<div class="infoButtonContainer">' +
                                                    '<div class="infoButtonS">' +
                                                    'Info' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '</a>' +
                                                    '<div class="date">' + data.jokes[i].created_at +
                                                    '</div>'
                                            );
                                        } else {
                                            $('#jokeTable').append(
                                                    '<div class="jokeInfo" id="jokeInfo">' +
                                                    '<div class="content">' + data.jokes[i].content +
                                                    '</div>' +
                                                    '<div class="stateSwitchButtonContainer">' +
                                                    '<div class="stateSwitchButtonU" id="stateSwitchButton' + i + '" title="' + data.jokes[i].id + '">' +
                                                    'Unactive' +
                                                    '</div>' +
                                                    '</div>' +
                                                    '<a href="/info/' +
                                                    data.jokes[i].id +
                                                    '">' +
                                                    '<div class="infoButtonContainer">' +
                                                    '<div class="infoButtonS">' +
                                                    'Info' +
                                                    '</div>' +
                                                    "</div>" +
                                                    '</a>' +
                                                    '<div class="date">' + data.jokes[i].created_at + '</div>'
                                            );
                                        }

                                        var stateSwitchButton = document.getElementById('stateSwitchButton' + i);
                                        stateSwitchButton.addEventListener('click', function changeState(e) {
                                            ajaxRequest(e.target.title);
                                            changeDiv(e.target.id, e.target.title, e.target.className);
                                        });
                                    }
                                }
                            }
                        }
                    });
                },
                false);

        // Prevent enter to submit form

        window.addEventListener('keydown', function (e) {
            if (e.key == 'U+000A' || e.key == 'Enter' || e.keyCode == 13) {
                if (e.target.nodeName == 'INPUT' && e.target.type == 'text') {
                    e.preventDefault();
                    return false;
                }
            }
        }, true);

    </script>
@endsection
