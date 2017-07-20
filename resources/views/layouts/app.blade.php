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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/morphine.min.css') }}" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js" defer></script>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
</head>
<body style="background-color: #e6e5e5;">

<header class="menu">
<ul>

    <span class="glyphicon glyphicon-console" style="color: #fff; margin-left: 25px;"></span>
    <span style="color: #fff;"> IT-Blog</span>

    <a href="/"><li class="menu__list">Главная</li></a>
    @if(!Auth::guest())
    <a href="{{route('home')}}"><li class="menu__list">Статьи</li></a>

    <a href="{{route('news')}}"><li class="menu__list">Новости</li></a>
    <a href="{{route('faq')}}"><li class="menu__list">FAQ</li></a>
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

        <a href="{{route('Author')}}"><li class="menu__list" id="menu__list-login"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->name}}</li></a>

@endif
{{--<input type="text" name="search" class="menu__search" placeholder="Поиск пользователей">--}}
    @endif
</ul>

</header>

<div class="grid">

    <div class="left-bar">
        @if(!Auth::guest())
        <div class="left-bar__menu">
            <ul>
                <a href="{{route('Author')}}">
                    <li class="left-bar__list"><span class="glyphicon glyphicon-home"></span> Моя страница</li>
                </a>
                <a href="{{route('friends')}}">
                    <li class="left-bar__list"><span class="glyphicon glyphicon-user"></span> Список друзей
                        <span class="label label-default">0</span></li>
                </a>
                <li class="left-bar__list">
                    <span class="glyphicon glyphicon-envelope"></span>  Сообщения
                    <span class="label label-default">0</span></li>
                <a href="{{route('home')}}">
                    <li class="left-bar__list"><span class="glyphicon glyphicon-list-alt"></span> Cтатьи</li>
                </a>
                <li class="left-bar__list"><span class="glyphicon glyphicon-bullhorn"></span>  Новости</li>
                <li class="left-bar__list"><span class="glyphicon glyphicon-star"></span>  Избранное</li>
            </ul>



        </div>

        <hr style="margin-left: 25px; margin-right: 25px;">
        @endif
    </div>

<div class="center">

    @yield('content')

</div>

    <div class="right-bar">
        @if(!Auth::guest())
        <aside class="right-bar__menu">
            <ul>
                <a href="{{route('user')}}">
                    <li class="right-bar__list"><span class="glyphicon glyphicon-list-alt"> Пользователи</span></li>
                </a>

            </ul>



        </aside>

        <hr style="margin-left: 25px; margin-right: 25px;">
        @endif
    </div>

</div>
</body>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</html>
