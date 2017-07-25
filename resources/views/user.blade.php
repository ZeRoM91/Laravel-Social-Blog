@extends('layouts.app')
@section('content')

<div class="user">
    <div class="grid__block lk__avatar">


            <span id="photo"> <span class="glyphicon glyphicon-camera" id="lk__avatar-icon"></span><span id="lk__avatar_hidden-text"> Редактировать фото</span>



    </div>
    <div class="grid__block lk__block-info">
        <h3>{{Auth::user()->name}}</h3>
        <span>Статус</span>
        <hr>
        <p>Имя: {{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
        <p>email: {{Auth::user()->email}}</p>


    </div>
    <div class="grid__block ">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-primary">Сообщение</button>
            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-gift"></span></button>
        </div>
        <hr>

        @if(isset($friend))
        <!-- Single button -->
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                У вас в друзьях <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>
@endif
    </div>

    <div class="grid__block"></div>

    <div class="grid__block"></div>

</div>
<span>{{$friend -> pivot}}</span>

@endsection