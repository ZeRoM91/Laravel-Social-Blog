<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
    <!-- Fonts -->
 </head>
<body style="background-color: #555;">

<header class="menu">
<ul class="menu-list">
    <a href="/">
        <li class="menu__list">
            <img src="/img/laravel.png" alt="" width="32" height="32">
    <span> Laravel Blog</span>
        </li>
    </a>

    @if(!Auth::guest())
    <a href="{{route('faq')}}"><li class="menu__list">Помощь</li></a>
@if(!Auth::guest())
@if(Auth::user()->id == 1)
    <a href="{{route('admin')}}"><li class="menu__list">Админка</li></a>
@endif
@endif
@if(!Auth::guest())
<a href="{{ route('logout') }}"
   onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"> <li class="menu__list">
        Выход
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li> </a>
    @else
    <a href="{{route('login')}}"><li class="menu__list" >Войти</li></a>
@endif
    @if(!Auth::guest())

        <a href="{{route('lk')}}"><li class="menu__list" id="menu__list-login">
                <img class="img-circle" src="{{isset(Auth::user()->avatar) ? asset('storage/avatars/' . Auth::user()->avatar) : '/img/avatar.jpg'}}">
                {{Auth::user()->name}}</li></a>
@endif
        <form action="{{route('searchUsers')}}" method="post" style="padding: 0; margin: 0; display: inline-block;">
           {{csrf_field()}}
<input type="text" name="searchUser" class="menu__search" placeholder="Поиск пользователей">
        </form>
    @endif
</ul>
</header>
<div class="grid">
    <div class="left-bar">
        @if(!Auth::guest())
        <div class="left-bar__menu">
            <ul>
                <a href="{{route('lk')}}">
                    <li class="left-bar__list"><span class="glyphicon glyphicon-home"></span> Моя страница</li>
                </a>
                <a href="{{route('friends')}}">
                    <li class="left-bar__list"><span class="glyphicon glyphicon-user"></span> Мои друзья
                        @if($friendCount)
                            <span class="label label-default">{{$friendCount}}</span>
                    @else

                    @endif
                    </li>
                </a>
                <a href="{{route('messages')}}">
                <li class="left-bar__list">
                    <span class="glyphicon glyphicon-envelope"></span>  Сообщения
                    @if($messageCount)
                    <span class="label label-default">

                        {{$messageCount}}

                    </span>
                    @else

                    @endif
                </li>
                </a>


                <a href="{{route('home')}}">
                    <li class="left-bar__list"><span class="glyphicon glyphicon-list-alt"></span> Cтатьи</li>
                </a>


                <a href="{{route('photos')}}">
                <li class="left-bar__list"><span class="glyphicon glyphicon-camera"></span>  Фотографии</li>
                </a>




              <div id="event-list">

              </div>


            </ul>







        </div>

                {{--<div class="panel panel-primary" id="audioplayer">--}}
                    {{--<!-- Default panel contents -->--}}
                    {{--<div class="panel-heading" id="handle">Audio Player <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="function () {--}}
{{--this.hide();--}}
                                {{--}"><span aria-hidden="true">&times;</span></button></div>--}}
                    {{--<div class="panel-body">--}}
                        {{--<p>{{$audio -> name}}</p>--}}
                        {{--<audio controls="controls">--}}

                            {{--Ваш браузер не поддерживает <code>audio</code> элемент.--}}
                            {{--<source  name="Song 1" src="{{asset('storage/' . Auth::user()->id . '/audios/' . $audio -> link)}}" type="audio/wav">--}}

                        {{--</audio>--}}
                    {{--</div>--}}
                {{--</div>--}}


        @endif
    </div>

<div class="root" id="root">
    <p class="notification">


    </p>
    <div class="panel panel-default">
        <div class="panel-heading">....</b> </div>

        <div class="panel-body">
    @yield('content')
        </div>
    </div>

</div>


</div>




</body>
<!-- Scripts -->






@stack('scripts')
<script src="{{ asset('js/app.js') }}" ></script>
<script src="{{ asset('js/jquery-3.2.1.js') }}" ></script>
<script src="{{ asset('js/events.js') }}"></script>
<script src="{{ asset('js/main.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

</html>
