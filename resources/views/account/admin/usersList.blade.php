@extends('layouts.app')

@section('moreCss')
    <link href="{{ URL::asset('css/account.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-20 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="yourJokesTitle">
                            Users
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="users">
                            <thead>
                            <tr>
                                <td>
                                    Name
                                </td>
                                <td>
                                    Email
                                </td>
                                <td>
                                    Role
                                </td>
                            </tr>
                            </thead>
                            @foreach($users as $user)

                                @if($user->id == Auth::user()->id)
                                    <tr class="currentUser">
                                        <td class="userName">
                                            {{ $user->name }}
                                        </td>
                                        <td class="userEmail">
                                            {{ $user->email }}
                                        </td>
                                        <td class="currentUserRole">
                                            {{ $user->role }}
                                        </td>
                                    </tr>
                                @else
                                    <tr class="user">
                                        <td class="userName">
                                            {{ $user->name }}
                                        </td>
                                        <td class="userEmail">
                                            {{ $user->email }}
                                        </td>
                                        <td class="userRole" id="userRole{{$user->id}}" title="{{$user->id}}">
                                            {{ $user->role }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/jquery-3.1.1.min.js') }}" type="text/javascript">
    </script>
    <script type="text/javascript">

                @foreach($users as $user)
                @if($user->id == Auth::user()->id)
                @else
        var userRoleButton = document.getElementById('userRole{{$user->id}}');
        userRoleButton.addEventListener('click', function changeRole(e) {
            ajaxRequest(e.target.title, e.target.innerHTML.trim());
            updateHtml(e.target.id, e.target.innerHTML.trim());
        });
        @endif
        @endforeach

        function ajaxRequest(targetUserId, targetBody) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/changeRole',
                dataType: 'JSON',
                data: {userId: targetUserId, currentRole: targetBody},
                success: function (data) {
                    console.log(data);
                }
            });
        }

        function updateHtml(divId, userRole) {
            var div = document.getElementById(divId);
            console.log(div);
            if (userRole == 'admin') {
                div.innerHTML = "user";
            } else {
                div.innerHTML = "admin";
            }

        }

    </script>
@endsection
