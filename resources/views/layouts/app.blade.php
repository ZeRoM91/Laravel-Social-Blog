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
    <link href="{{ asset('css/button.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">


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
    <a href="{{route('Author')}}"><li class="menu__list">Личный кабинет</li></a>
    <li class="menu__list">Новости</li>
    <li class="menu__list">FAQ</li>
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
    <a href="{{route('login')}}"><li class="menu__list">Войти</li></a>
@endif


<input type="text" name="search" class="menu__search" placeholder="Поиск статей">
</ul>

</header>

{{--<aside class="left-bar">--}}
{{--<ul>--}}
{{--<li class="left-bar__list" >Мои настройки</li>--}}
{{--<li class="left-bar__list">Мои статьи</li>--}}
{{--<li class="left-bar__list">Друзья</li>--}}
{{--<li class="left-bar__list">Сообщения</li>--}}

{{--</ul>--}}

{{--</aside>--}}
<div class="container">
@yield('content')
</div>
</body>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</html>
