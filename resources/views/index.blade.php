@extends('layouts.app')

@section('content')

    <main class="main">

<div class="grid__block main__block-header">

    <h2>Привет, {{Auth::user()->firstname}}!</h2>

    <hr>
</div>
        <div class="grid__block main__block-left-bar">

            <p>Статистика</p>

            <hr>
<p>Статей на портале: {{$articleCount}}</p>
<p>Комментариев на портале: {{$commentCount}}</p>
<p>Пользователей на портале: {{$userCount}}</p>
<p>Отправленных сообщений: {{$messageCount}}</p>

            <ul id="event-list">

            </ul>
        </div>
        <div class="grid__block">
            <p>Самая читаемая статья</p>
            <div class="panel-heading" style="color: #666; opacity: .75;">
                <a href="{{route('article' ,['id' => $topArticle ->id])}}">
            <span> {{$topArticle ->title}}</span>
                </a>
            </div>
            <div class="panel-footer" style="color: #666; opacity: .75;">
                <span class="glyphicon glyphicon-eye-open" ></span><span> {{$topArticle ->views}}</span>
                <span class="glyphicon glyphicon-heart" ></span><span> {{$topArticle ->rating}}</span>
                <span class="glyphicon glyphicon-comment" ></span><span> {{$topArticle ->comment->count()}}</span>
            </div>
            <p>Самая рейтинговая статья</p>
            <div class="panel-heading" style="color: #666; opacity: .75;">
                <a href="{{route('article' ,['id' => $ratingArticle ->id])}}">
                    <span> {{$ratingArticle ->title}}</span>
                </a>
            </div>
            <div class="panel-footer" style="color: #666; opacity: .75;">
                <span class="glyphicon glyphicon-eye-open" ></span><span> {{$ratingArticle ->views}}</span>
                <span class="glyphicon glyphicon-heart" ></span><span> {{$ratingArticle ->rating}}</span>
                <span class="glyphicon glyphicon-comment" ></span><span> {{$ratingArticle ->comment->count()}}</span>
            </div>

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