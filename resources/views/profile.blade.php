@extends('layouts.app')

@section('content')


    <p><b>Пользователь, {{$user->name}}</b><br>
        <img src="http://findicons.com/files/icons/61/dragon_soft/256/user.png" alt="..." class="img-thumbnail">
    <p>Зарегестрирован: {{Auth::user()->created_at}}</p>
<h2>Список друзей</h2>

@if(Auth::user()-> id != $user->id)

    @foreach($friends as $friend)
    @if($friend)

        <a href=""><button class="button button-static">Это ваш друг</button></a>
@else

    <a href="{{route('user__send-friend',['id' => $user->id])}}"><button class="button button-primary">Добавить в друзья</button></a>
@endif
        @endforeach

    @foreach($outcomings as $outcoming)
        @if($outcoming)

            <a href=""><button class="button button-static">Вы уже отправили запрос в друзья</button></a>
        @else

            <a href="{{route('user__send-friend',['id' => $user->id])}}"><button class="button button-primary">Добавить в друзья</button></a>
        @endif
    @endforeach

    @foreach($incomings as $incoming)
        @if($incoming)

            <a href=""><button class="button button-static">Этот пользователь хочет добавить вас в друзья</button></a>
            <a href="{{route('user__friend-accept', ['id' => $incoming -> id])}}"><button class="button button-success">Принять</button></a>
            <button class="button button-danger">Отклонить</button>
        @else

            <a href="{{route('user__send-friend',['id' => $user->id])}}"><button class="button button-primary">Добавить в друзья</button></a>
        @endif
    @endforeach

    <a href=""><button class="button button-static">Написать сообщение</button></a>

@else
        <p>Это ваш профиль</p>
@endif







@endsection