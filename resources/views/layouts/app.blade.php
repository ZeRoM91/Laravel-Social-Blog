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





    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<body style="background-color: #e6e5e5;">

<header class="menu">
<ul>

    <span class="glyphicon glyphicon-console" style="color: #fff; margin-left: 25px;"></span>
    <span style="color: #fff;"> IT-Blog</span>
    <a href="/"><li class="menu__list">Главная</li></a>
    <a href="{{route('home')}}"><li class="menu__list">Статьи</li></a>

    <li class="menu__list">Новости</li>
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

        <a href="{{route('Author')}}"><li class="menu__list" style="float: right; margin-right: 75px;"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->name}}</li></a>

@endif
<input type="text" name="search" class="menu__search" placeholder="Поиск пользователей">
</ul>

</header>
<aside class="side-bar">
    <div class="left-bar">
        <ul>
            <li class="left-bar__list button button-primary"><span class="glyphicon glyphicon-user"></span> Друзья</li>
            <li class="left-bar__list button button-success"><span class="glyphicon glyphicon-envelope"></span>  Сообщения</li>
            <li class="left-bar__list button button-info"><span class="glyphicon glyphicon-list-alt"></span> Мои статьи</li>
            <li class="left-bar__list button button-dark"><span class="glyphicon glyphicon-cog"></span> Мои настройки</li>
            <li class="left-bar__list button button-static"><span class="glyphicon glyphicon-star"></span> Избранное</li>
        </ul>
    </div>


</aside>
<div class="container">
@yield('content')
</div>
</body>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</html>
