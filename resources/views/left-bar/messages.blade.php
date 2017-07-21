@extends('layouts.app')
@section('content')

@foreach($messages__unread as $message)
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{{$message->created_at}}</p>
        <strong>{{$message->userFrom->name}}:</strong> {{$message->message}}
    </div>
    @endforeach


<div class="messages__friends">
@foreach($friends as $friend)
    <div class="grid__block">


                    <a href="{{route('messages__user' ,['id' => $friend ->id])}}"> <p>{{$friend->name}}</p></a>


            </div>
@endforeach

</div>
    @endsection