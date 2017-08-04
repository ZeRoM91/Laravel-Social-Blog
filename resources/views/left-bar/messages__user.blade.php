@extends('layouts.app')

@section('content')
    <div class="messages__user">
        <div class="messages__friends">
            @foreach($friends as $friend)
                <a href="{{route('messages__user',['id' => $friend -> pivot -> to_user_id])}}">
                    <p><b>{{$friend -> firstname}} {{$friend -> lastname}}</b></p>
                </a>

                <a href="{{ route('messages__user' ,['id' => $friend->id])}}">
                    @if($friend->messages()->orderBy('created_at', 'desc')->first()->status == false)
                        <p class="label label-success"><strong>

                                {{ str_limit($friend->messages()->orderBy('created_at', 'desc')->first()->message, $limit = 32, $end = '...') }}
                            </strong></p>

                    @else

                        <p class="label label-info"><i>{{ str_limit($friend->messages()->orderBy('created_at', 'desc')->first()->message, $limit = 32, $end = '...') }}</i></p>


                    @endif
                </a>
                <hr>
            @endforeach
        </div>

                            <div class="message-box">

@foreach($messages as $message)

@if($message->to_user_id == Auth::user() ->id)
    <div class="message__from">
        <p class="message__time">{{$message->created_at}}</p>
        <img class="img-circle" src="{{isset($user->avatar) ? asset('storage/avatars/' . $user->avatar) : '/img/avatar.jpg'}}">

        <span class="message__time">{{$message->message}}</span>
    </div>
                                    <hr>
    @else

    @if($message-> status == true)
                                        <div class="message__to">

                                            <p class="message__time">{{$message->created_at}}</p>
                                            <img class="img-circle" src="{{isset(\Auth::user()->avatar) ? asset('storage/avatars/' . \Auth::user()->avatar) : '/img/avatar.jpg'}}">

                                            <span class="message__time">{{$message->message}}</span>
                                        </div>
                                        @else
                                        <div class="message__to">

                                            <p class="message__time">{{$message->created_at}}</p>
                                            <img class="img-circle" src="{{isset(\Auth::user()->avatar) ? asset('storage/avatars/' . \Auth::user()->avatar) : '/img/avatar.jpg'}}">

                                            <span class="message__time">{{$message->message}}</span>
                                               <span><i>(Не прочитано)</i></span>
                                        </div>
                                            @endif
                                    @endif


    @endforeach

                            </div>
    </div>

    <br>
                     {{--   <form action="{{route('user__message-send',['id' => $user->id ])}}" method="post">--}}
                        <form method="post" id="message">

                            {{ csrf_field() }}
                            
                            <textarea type="text" name="message" id="message3" class="form-control" placeholder="Введите ваше сообщение. Для отправки сообщения нажмите [Enter]" rows="4" style="resize: none"></textarea>                    </textarea>
                            <br>

                            <button type="submit" class="btn btn-info" value="Отправить" id="send"> <span class="glyphicon glyphicon-send"></span> Отправить</button>


                        </form>
    <script>

    </script>
@endsection