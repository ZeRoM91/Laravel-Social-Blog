@extends('layouts.app')

@section('content')


    <p><b>Пользователь, {{$user->name}}</b><br>
        <img src="http://findicons.com/files/icons/61/dragon_soft/256/user.png" alt="..." class="img-thumbnail">
    <p>Зарегестрирован: {{Auth::user()->created_at}}</p>
<h2>Список друзей</h2>
    <a href="{{route('user__send-friend',['id' => $user->id])}}"><button class="button button-primary">Добавить в друзья</button></a>
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
            <a href="{{route('user__send-friend',['id' => $user->id])}}"><button class="button button-primary">Добавить в друзья</button></a>
        @endif
        <a href="{{route('user__send-friend',['id' => $user->id])}}"><button class="button button-primary">Добавить в друзья</button></a>
    @endforeach

    <button class="button button-primary" id="message__write" data-toggle="modal" data-target="#messageModal">Написать сообщение</button>

@else
        <p>Это ваш профиль</p>
@endif



    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="messageModal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content" style="padding: 20px;">
                <div class="message-box" style="
    border: 1px solid rgba(155,155,155,.5);
    background-color: #f0f0f0; padding: 12px; overflow: scroll; height: 200px;">


                    Тут будут ваши сообщения

                </div>
                <form  action="{{route('user__message-send',['id' => $friend->id])}}" method="post">

                    {{ csrf_field() }}


                    <input type="text" name="message3" class="form-control" placeholder="Ввведите ваше сообщение">


                    <input type="submit" class="button button-success" value="Отправить">

                </form>

            </div>
        </div>
    </div>

    <script>
        $('#messageModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })
    </script>




@endsection