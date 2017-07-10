@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Список статей <span><b> ({{$articles->count()}}).</b></div>

                <div class="panel-body">


                    @foreach($articles as $article)

                        <span><b>#{{$article['id']}}.</b></span>
                        <span>{{$article['time']}}</span>
                        <a href="{{ route('article', ['id' => $article['id']]) }}"><p><b>{{$article['title']}}</b></p></a>
                        <i>Автор: </i><span class="badge badge-primary">{{$article['author']}}</span>
                        <hr>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
