@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Личный кабинет</b> </div>

                    <div class="panel-body">

                <h1>Ваши статьи</h1>
                        @foreach($articles as $article)

                            {{--<a href="/article/{{$article['id']}}"><h1>{{$article['title']}}</h1></a>--}}
                            <span>{{$article['time']}}</span>
                            <a href="{{ route('article', ['id' => $article['id']]) }}"><p><b>{{$article['title']}}</b></p></a>

                            <hr>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection