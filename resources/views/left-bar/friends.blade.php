@extends('layouts.app')

@section('content')
    @foreach($incomings as $friend)
        <div class="panel panel-default">
            <div class="panel-body">

                <p>Пользователь <b>{{$friend -> firstname}} {{$friend -> lastname}}</b> хочет добавить вас в друзья</p>
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
   <div class="grid__block">
                <a href="{{route('user__profile',['id' => $friend -> pivot -> to_user_id])}}">
                    <p><b>{{$friend -> firstname}} {{$friend -> lastname}}</b></p>
                </a>
                    <span style="color: #666;">Онлайн</span>
                    <hr>

                <a href="{{route('messages__user', ['id' => $friend -> pivot -> to_user_id])}}">
                    <button class="btn btn-default">Написать сообщение</button>
                </a>

                <a href="{{route('user__friend-decline', ['id' => $friend -> pivot -> to_user_id])}}">
                    <button class="btn btn-default">Удалить из друзей</button>
                </a>

   </div>
    @endforeach
@endsection