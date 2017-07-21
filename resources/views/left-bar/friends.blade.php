@extends('layouts.app')

@section('content')
    @foreach($incomings as $friend)
        <div class="panel panel-default">
            <div class="panel-body">

                <p>Пользователь <b>{{$friend -> name}}</b> хочет добавить вас в друзья</p>
                <a href="{{route('user__friend-accept', ['id' => $friend->id])}}">
                    <button class="btn btn-success">Добавить в друзья</button>
                </a>
                <a href="{{route('user__friend-decline', ['id' => $friend->id])}}">
                    <button class="btn btn-danger">Отклонить</button>
                </a>
            </div>
            <div class="panel-footer">

            </div>
        </div>
    @endforeach

    @foreach($friends as $friend)
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="{{route('user__profile',['id' => $friend -> pivot -> to_user_id])}}">
                    <p>{{$friend -> name}}</p>
                </a>
                <a href="{{route('messages__user', ['id' => $friend -> pivot -> to_user_id])}}">
                    <button class="btn btn-default">Написать сообщение</button>
                </a>
                <a href="{{route('user__friend-decline', ['id' => $friend -> pivot -> to_user_id])}}">
                    <button class="btn btn-default">Удалить из друзей</button>
                </a>
            </div>
            <div class="panel-footer">
                Вы дружите с <span>{{$friend -> created_at}}</span>
            </div>
        </div>
    @endforeach
@endsection