@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Список статей</div>
                    <div class="panel-body">
                        @foreach($articles as $article)


                        <span class="label label-success">{{$article['created_at']}}</span>
                        <a href="{{ route('article', ['id' => $article['id']]) }}"><h3><b>"{{$article['title']}}"</b></h3></a>
                        <i>Автор: </i><span class="label label-default">{{$article ->author['name']}}</span>
                        <i>Рейтинг: </i><span class="label label-info">{{$article ->rating}}</span>
                        <i>Комментариев: </i><span class="label label-warning">{{$article ->comment->count()}}</span>

                        <hr>



                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
