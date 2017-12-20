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
                        <p class="label label-info">
                            <i>{{ str_limit($friend->messages()->orderBy('created_at', 'desc')->first()->message, $limit = 32, $end = '...') }}</i>
                        </p>
                    @endif
                </a>
                <hr>
            @endforeach
        </div>
        <div class="grid__block"><p class="text-center">Выберите чат</p>
        </div>
    </div>
@stop