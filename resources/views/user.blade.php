@extends('layouts.app')
@section('content')

<div class="user">

    <div class="grid__block lk__avatar">
    </div>
    <div class="grid__block lk__block-info">
        <h3>{{$user->firstname}} {{$user->lastname}}</h3>
        <span>Статус</span>
        <hr>





    </div>
    <div class="grid__block ">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-primary">Сообщение</button>
            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-gift"></span></button>
        </div>
        <hr>




    @if(isset($status -> pivot -> status))

    @if($status -> pivot -> status === 1)

        <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
          @if($status -> pivot -> status === 0)

                <button type="button" class="btn btn-info" disabled>
                    Предложение отправлено
                </button>



        @endif

        @endif


        @if(!isset($status -> pivot -> status))


            <a href="{{route('user__friend-send', ['id' => $user->id])}}">
                <button class="btn btn-success">Добавить в друзья</button>
            </a>


        @endif


    </div>

    <div class="grid__block">

        <p>Друзья: 5</p> <p>Статьи: 5</p> <p>Комментарии: 5</p>

    </div>

    <div class="grid__block"></div>

</div>



@endsection