@extends('layouts.app')
@section('content')
    <div class="messages__user">
        <div class="messages__friends">
        @foreach($friends as $friend)
            <div class="grid__block">
                <a href="{{route('messages__user',['id' => $friend -> pivot -> to_user_id])}}">
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

        <div class="grid__block"> <p class="text-center">Выберите чат</p>
        </div>
    </div>
@stop