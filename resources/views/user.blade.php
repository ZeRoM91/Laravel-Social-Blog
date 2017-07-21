@extends('layouts.app')
@section('content')

<div class="user">
   <div class="grid__block">

       <img id="user__img" src="http://www.atiras.co/file/2014/07/user_user_icon_user_png_flat_icon_web_icon_png_circle_icon-440x440.png" alt="" height="150">
       <a href="{{route('user__send-friend', ['id' => $user->id])}}">
<button class="btn btn-default">Добавить в друзья</button>
       </a>
   </div>
    <div class="grid__block">


        <p><b>Данные пользователя</b>
        <p> логин:</p>
        <p>Имя:</p>
        <p> email: </p>
        <p>Аккаунт создан: </p>
        Тест: <br>

    </div>
    <div class="grid__block lk__block-tab">
        Список друзей

    </div>

    <div class="grid__block"></div>

    <div class="grid__block"></div>

</div>


@endsection