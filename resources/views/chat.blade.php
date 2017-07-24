@extends('layouts.app')
@section('content')

    <div class="well" style="height: 400px; max-height: 400px; overflow-y: scroll;">

        <ul class="chat">
@foreach($messages as $message)
<li>
    <b>{{$message->author}}</b>
    <p>{{$message->content}}</p>
</li>

    @endforeach
        </ul>

    </div>
    <hr>
    <form action="/chat" method="POST">


        {{ csrf_field() }}
        <input type="hidden" name="author" value="{{Auth::user()->name}}">
        <textarea name="content" class="form-control" placeholder="Введите ваше сообщение" rows="4" style="resize: none"></textarea><br>

        <input type="submit" class="btn btn-success" value="Отправить">
    </form>
    <br>


    <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

<script>
    var socket = io(':6001');

    function appendMessage(data) {
        $('.chat').append(
            $('<li/>').append(
                $('<b/>').text(data.author),
                $('<p/>').text(data.content)
            )

        );
    }
//        $('form').on('submit', function() {
//
//            var text = $('textarea').val(),
//                msg = {message : text};
//            socket.send(msg);
//            appendMessage(msg);
//
//            $('textarea').val('');
//           return false;
//        });
        socket.on('chat:message', function(data) {
            console.log(data);
            appendMessage(data);
        });
</script>
@endsection