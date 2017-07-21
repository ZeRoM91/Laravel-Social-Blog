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
                                        <div class="message__to">
                                            <p class="message__time">{{$message->created_at}}</p>
                                            <p class="message__time">{{$message->message}}</p>
                                        </div>
                                    @endif


    @endforeach









                            </div>

                        </div>
                    </div>

                    <div class="messages__write-block">
                        <form   method="post">

                            {{ csrf_field() }}


                            <textarea type="text" name="message3" class="form-control" placeholder="Введите ваше сообщение" rows="4" style="resize: none"></textarea>                    </textarea>
                            <br>
                            <input type="submit" class="btn btn-success" value="Отправить">

                        </form>
                    </div>

            </div>
        </div>

    </div>
    </div>



@endsection