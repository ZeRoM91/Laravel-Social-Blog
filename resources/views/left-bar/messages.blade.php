@extends('layouts.app')

@section('content')
    <div class="messages__friends">
        @foreach($friends as $friend)
            <div class="grid__block">
                <a href="{{ route('messages__user' ,['id' => $friend->id])}}">{{$friend->name}}</a>
                <p>{{ $friend->messages()->orderBy('created_at', 'desc')->first()->message }}</p>

            </div>
        @endforeach
    </div>
@stop