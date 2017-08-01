@extends('layouts.app')

@section('content')

    <main class="main">

<div class="grid__block main__block-header">

    <h2>Привет, {{Auth::user()->firstname}}!</h2>

    <hr>
</div>
        <div class="grid__block main__block-left-bar">

            <p>Последние события</p>

            <hr>

            <ul id="event-list">

            </ul>
        </div>
        <div class="grid__block">


        </div>
        <div class="grid__block"> 
        <p>Ваш фотоальбом</p>
            <hr>
            @if(isset($photo -> link))
            <img src="{{asset('storage/' . Auth::user()->id . '/photos/' . $photo -> link)}}" alt="" width="200">
        @else

            <p>У вас еще нет фотографий</p>
                <a href="{{route('photos')}}">
                <button class="btn btn-success">Загрузить</button>
                </a>
                @endif
        </div>
        <div class="grid__block main__block-footer">Footer</div>
    </main>

@endsection