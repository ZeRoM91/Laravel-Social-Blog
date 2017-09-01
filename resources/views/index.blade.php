@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="grid__block main__block-header">
            <h2>Привет, {{Auth::user()->firstname}}!</h2>
            <hr>
        </div>
        <div class="grid__block main__block-left-bar">
            <h2>Статьи</h2>
            <hr>
            <h4>Топ-5 по просмотрам</h4>
                <a href="{{route('article' ,['id' => $topArticle->id])}}">
                    <p>
                    <span> {{$topArticle ->title}}</span>
                </a>
                <span class="glyphicon glyphicon-eye-open"></span><span> {{$topArticle ->views}}</span>
                <span class="glyphicon glyphicon-heart"></span><span> {{$topArticle ->rating}}</span>
                <span class="glyphicon glyphicon-comment"></span><span> {{$topArticle ->comment->count()}}</span>
            </p>
            <h4>Топ-5 по рейтингу</h4>
                <a href="{{route('article' ,['id' => $ratingArticle ->id])}}">
                    <p>
                    <span>{{$ratingArticle ->title}}</span>
                </a>

                <span class="glyphicon glyphicon-eye-open"></span><span> {{$ratingArticle ->views}}</span>
                <span class="glyphicon glyphicon-heart"></span><span> {{$ratingArticle ->rating}}</span>
                <span class="glyphicon glyphicon-comment"></span><span> {{$ratingArticle ->comment->count()}}</span>
        </p>
        </div>
        <div class="grid__block">


            <p>Последние комментарии</p>

            <hr>

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
        <div class="grid__block main__block-footer">
            <h2>Статистика портала</h2>
            <hr>
            <p>Статей на портале: {{$articleCount}}</p>
            <p>Комментариев на портале: {{$commentCount}}</p>
            <p>Пользователей на портале: {{$userCount}}</p>
            <p>Отправленных сообщений: {{$messageCount}}</p>

        </div>
    </main>

@endsection
