@extends('layouts.app')

@section('content')

    <h2>Тут будет список друзей</h2>


    @foreach($friends as $friend)

        <div class="panel panel-default">
            <div class="panel-body">
                <a href="{{route('user__profile',['id' => $friend -> pivot -> to_user_id])}}">  <p>{{$friend -> name}}</p></a>
            </div>
            <div class="panel-footer">

                Вы дружите с <span>{{$friend -> created_at}}</span>
            </div>
        </div>
    @endforeach
@endsection