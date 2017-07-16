@extends('layouts.app')

@section('content')


    <p><b>Данные пользователя {{Auth::user()->name}}</b>

    <p>Зарегестрирован: {{Auth::user()->created_at}}</p>

    <a href="" class="bn bn-primary">Добавить в друзья</a>
    <a href="" class="bn bn-warning">Написать сообщение</a>
@endsection