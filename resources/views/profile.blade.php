@extends('layouts.app')

@section('content')


    <p><b>Пользователь, {{Auth::user()->name}}</b><br>
        <img src="http://findicons.com/files/icons/61/dragon_soft/256/user.png" alt="..." class="img-thumbnail">
    <p>Зарегестрирован: {{Auth::user()->created_at}}</p>
<h2>Список друзей</h2>
    @foreach($friends as $friend)

    <p>{{$friend}}</p>

    @endforeach

    <a href="{{route('user__send-friend',['id' => $user->id])}}"><button class="button button-primary">Добавить в друзья</button></a>
    <a href=""><button class="button button-accent">Написать сообщение</button></a>



@endsection