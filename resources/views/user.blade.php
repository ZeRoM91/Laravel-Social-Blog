@extends('layouts.app')
@section('content')

<div class="user">

    <div class="grid__block lk__avatar">

        <img id="avatar-photo" src="{{asset('avatars/' . $user->avatar)}}" >
    </div>
    <div class="grid__block lk__block-info">
        <h3>{{$user->firstname}} {{$user->lastname}}</h3>
        @if(isset($status))
        <span>{{$status  -> status}}</span>
        @endif
        <hr>





    </div>
    <div class="grid__block ">



@if($user -> id != Auth::user()->id)

    @if(isset($isFriend -> pivot -> status))

    @if($isFriend -> pivot -> status === 1)
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-primary">Сообщение</button>
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-gift"></span></button>
                </div>
                <hr>
        <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    У вас в друзьях <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>                <a href="{{route('user__friend-decline', ['id' => $isFriend -> pivot -> to_user_id])}}">
                            <button class="btn btn-danger">Удалить из друзей</button>
                        </a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>

        @endif
          @if($isFriend -> pivot -> status === 0)

                <button type="button" class="btn btn-info" disabled>
                    Предложение отправлено
                </button>



        @endif

        @endif


        @if(!isset($isFriend -> pivot -> status))


            <a href="{{route('user__friend-send', ['id' => $user->id])}}">
                <button class="btn btn-success">Добавить в друзья</button>
            </a>


        @endif


    @else
            <button class="btn btn-warning" disabled>Это ваш профиль</button>

        @endif
    </div>

    <div class="grid__block">




    </div>

    <div class="grid__block"></div>

</div>



@endsection