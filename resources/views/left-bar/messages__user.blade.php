@extends('layouts.app')

@section('content')


    <div class="messages__user">



        <div class="grid__block" style="padding: 5px;">

            <div class="messages__write">

                    <div class="messages__write-block">
                        <div class="panel panel-default">

                            <p>Чат с пользователем </p>
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
                        <form action="{{route('user__message-send',['id' => $user->id])}}"   method="post">

                            {{ csrf_field() }}


                            <textarea type="text" name="message" id="message3" class="form-control" placeholder="Введите ваше сообщение" rows="4" style="resize: none"></textarea>                    </textarea>
                            <br>
                            <input type="submit" class="btn btn-success" value="Отправить" id="send">

                        </form>
                    </div>

            </div>
        </div>

    </div>


    <script
            src="http://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>

    @push('scripts')
        <script>


            Echo.channel('user.private.{{ $user->id }}')
                .listen('.user.message', function(e) {
                   console.log(e);
                });

            $('#send').click(function(e) {
                var data = {
                    "message": $('#message3').val(),
                    "to_user_id": {{ $message->to_user_id }}
                };

                $.post('', data, function(response) {
                    $('.message-box').append("<div class='message__to'>" + data.message + "</div>");
                });

                e.preventDefault()
            });

</script>
    @endpush
@endsection