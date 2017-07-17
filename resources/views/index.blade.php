@extends('layouts.app')

@section('content')

    <h1>Привет, {{Auth::user()->name}} </h1>
    @if(Auth::user())
    <a href="{{route('create')}}" ><button class="button button-accent">Создать статью</button></a><br>
        <p>Справка по созданию статьи</p>
        <a href="{{route('faq')}}" ><button class="button button-info">FAQ</button></a><br><br>
    <a href="{{route('user')}}" ><button class="button button-private">Пользователи</button></a><br>
        @else
        <h1>Привет гость!</h1>
        <p>Для входа на сайт пройдите на форму входа ниже:</p>
        <a href="{{route('login')}}" ><button class="button button-success">Войти</button></a>
@endif

@endsection