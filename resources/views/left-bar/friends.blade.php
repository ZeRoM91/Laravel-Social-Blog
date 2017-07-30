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

        <div class="panel panel-default">
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Заявки в друзья
                            <span class="badge">{{$outcomings -> count()}} </span>
                        </a>

                    </li>
                    <li role="presentation">
                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Запросы в друзья
                            <span class="badge">{{$incomings -> count()}} </span>
                        </a>

                    </li>
                    <li role="presentation">
                        <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Мои друзья
                            <span class="badge"> {{$friends -> count()}}</span>
                        </a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        @foreach($outcomings as $outcoming)
                            <button class="btn btn-info"> <span class="glyphicon glyphicon-user"> {{$outcoming -> name}}</span></button> <span class="label label-default">Ожидание</span>
                        @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        @foreach($incomings as $incoming)
                            <button class="btn btn-warning"> <span class="glyphicon glyphicon-user"> {{$incoming ->name}}</span></button>

                            <a href="{{route('user__friend-accept', ['id' => $incoming -> id])}}"><button class="button button-success">Принять</button></a>
                            <button class="button button-danger">Отклонить</button>

                        @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        @foreach($friends as $friend)
                            <button class="btn btn-primary"> <span class="glyphicon glyphicon-success"> {{$friend -> name}}</span></button>

                            <a href="{{route('user__friend-decline', ['id' => $friend -> id])}}"><button class="btn btn-danger">Удалить из друзей</button></a>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>

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