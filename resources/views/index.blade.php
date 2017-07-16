@extends('layouts.app')

@section('content')

    <h1>Добро пожаловать</h1>
    <a href="{{route('create')}}" ><button class="button button-accent">Создать статью</button></a>

@endsection