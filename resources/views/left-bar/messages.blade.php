@extends('layouts.app')

@section('content')
    <div class="messages__friends">
        @foreach($friends as $friend)

            <div class="grid__block">

               <p>{{$friend->name}}</p>
                <a href="{{ route('messages__user' ,['id' => $friend->id])}}">
                @if($friend->messages()->orderBy('created_at', 'desc')->first()->status == false)

                <p class="alert alert-success"><strong>{{ $friend->messages()->orderBy('created_at', 'desc')->first()->message }}</strong></p>

                    @else

                    <p class="alert alert-info">{{ $friend->messages()->orderBy('created_at', 'desc')->first()->message }}</p>


@endif
                </a>
            </div>

        @endforeach
    </div>
@stop