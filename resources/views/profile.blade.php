@extends('layouts.app')

@section('content')
<div class="box">

    <p><b>Пользователь, {{$user->name}}</b><br>

    <p>Зарегестрирован: {{Auth::user()->created_at}}</p>



    <a href="{{route('user__send-friend',['id' => $user->id])}}"><button class="btn btn-primary">Добавить в друзья</button></a>



@if(Auth::user()-> id != $user->id)

    @foreach($friends as $friend)
    @if($friend -> pivot -> to_user_id == $user -> id)

        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>!</strong> Этот пользовательваш друг
        </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        Чат с пользователем {{$friend -> name}}
                    </div>
                    <div class="panel-footer">
<div class="message-box">

                        @foreach($messages as $message)

    <div class="message__to">
        <p class="message-time">{{$message -> created_at}}</p>
                           <p>{{Auth::user()-> name}}:{{$message -> message}}</p>
    </div>

                        @endforeach

                            @foreach($messages_in as $message)

                                <div class="message__from">
                                    <p class="message-time">{{$message -> created_at}}</p>
                                <p>{{$friend -> name}}: {{$message -> message}}</p>


                                </div>

                            @endforeach

                    </div>
                    </div>
                </div>
                <form   method="post">

                    {{ csrf_field() }}


                    <textarea type="text" name="message3" class="form-control" placeholder="Введите ваше сообщение" rows="3" style="resize: none">

                    </textarea>
                    <br>
                    <input type="submit" class="btn btn-success" value="Отправить">

                </form>


@endif
        @endforeach

    @foreach($outcomings as $outcoming)
        @if($outcoming)
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>!</strong> Вы уже отправили запрос в друзья
            </div>


        @endif
    @endforeach

    @foreach($incomings as $incoming)
        @if($incoming)

            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>!</strong> Этот пользователь хочет добавить вас в друзья
            </div>
            <a href="{{route('user__friend-accept', ['id' => $incoming -> id])}}"><button class="btn btn-success">Принять</button></a>
            <button class="btn btn-danger">Отклонить</button>
        @endif

    @endforeach



@else
        <p>Это ваш профиль</p>
@endif







                </div>





<script src="js/app.js"></script>

@endsection