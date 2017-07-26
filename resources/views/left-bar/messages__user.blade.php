@extends('layouts.app')

@section('content')
    <div class="messages__user">
    <div class="messages__friends">
        @foreach($friends as $friend)
            <div class="grid__block">
                <a href="{{route('user__profile',['id' => $friend -> pivot -> to_user_id])}}">
                    <p><b>{{$friend -> firstname}} {{$friend -> lastname}}</b></p>
                </a>
                <hr>
                <a href="{{ route('messages__user' ,['id' => $friend->id])}}">
                    @if($friend->messages()->orderBy('created_at', 'desc')->first()->status == false)
                        <p class="alert alert-success"><strong>
                                {{ str_limit($friend->messages()->orderBy('created_at', 'desc')->first()->message, $limit = 32, $end = '...') }}
                            </strong></p>

                    @else

                        <p style="color:#666;"><i>{{ str_limit($friend->messages()->orderBy('created_at', 'desc')->first()->message, $limit = 32, $end = '...') }}</i></p>


                    @endif
                </a>
            </div>

        @endforeach
    </div>





        <div class="grid__block" style="padding: 5px;">

            <div class="messages__write">

                    <div class="messages__write-block">
                        <div class="panel panel-default">
                            <p><b>Чат с {{$friend -> firstname}} {{$friend -> lastname}}</b></p>
                            <div class="message-box">

@foreach($messages as $message)

@if($message->to_user_id == Auth::user() ->id)
    <div class="message__from">
        <p class="message__time">{{$message->created_at}}</p>
        <p class="message__time">{{$message->message}}</p>
    </div>
                                    <hr>
    @else

    @if($message-> status == true)
                                        <div class="message__to">
                                            <p class="message__time">{{$message->created_at}}</p>
                                            <p class="message__time">{{$message->message}}</p>
                                        </div>
                                        @else
                                        <div class="message__to">

                                            <p class="message__time">{{$message->created_at}}</p>
                                            <p class="message__time">{{$message->message}}</p>
                                               <span><i>(Не прочитано)</i></span>
                                        </div>
                                            @endif
                                    @endif


    @endforeach









                            </div>

                        </div>
                    </div>

                    <div class="messages__write-block">
                        {{--<form action="{{route('user__message-send',['id' => $user->id ])}}" method="post">--}}
                        <form method="post">

                            {{ csrf_field() }}


                            <textarea type="text" name="message" id="message3" class="form-control" placeholder="Введите ваше сообщение" rows="4" style="resize: none"></textarea>                    </textarea>
                            <br>
                            <input type="submit" class="btn btn-success" value="Отправить" id="send">

                        </form>


                    </div>

            </div>
        </div>

    </div>


    {{--<script type="text/javascript" src="http://localhost:6001/socket.io/socket.io.js"></script>--}}

@push('scripts')
        <script>

            {{--$('#send').on('click', function () {--}}
                {{--let message = $('#message3').val();--}}

                    {{--$.ajax({--}}
                        {{--headers: {--}}
                            {{--'X-CSRFToken': $('meta[name="token"]').attr('content')--}}
                        {{--},--}}
                        {{--url: '',--}}
                        {{--type: 'POST',--}}
                        {{--dataType: 'json',--}}
                        {{--data: {message: message},--}}

                    {{--});--}}

            {{--});--}}

            {{--Echo.channel('user.private.{{ $user->id }}')--}}
                {{--.listen('.user.message', function(e) {--}}
                    {{--console.log(e);--}}
                   {{--$('.message-box').append(`<div class="message__to">test</div>`);--}}
                {{--});--}}

</script>
@endpush
@endsection