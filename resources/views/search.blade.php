@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <!-- Split button -->

                        <div class="btn-group">

                            <button type="button" class="btn btn-danger">Категории</button>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('homeCategory', ['category' => 'PHP'])}}">PHP</a></li>
                                <li><a href="{{route('homeCategory', ['category' => 'HTML'])}}">HTML</a></li>
                                <li><a href="{{route('homeCategory', ['category' => 'CSS'])}}">CSS</a></li>
                                <li><a href="{{route('homeCategory', ['category' => 'JS'])}}">Javascript</a></li>
                                <li><a href="{{route('home')}}">Все категории</a></li>
                            </ul>

                        </div>
                        <br><br>
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="input-group input-group col-md-8">
                                <input type="submit" class="btn btn-primary">
                                <input type="text" name="search" class="form-control" placeholder="Поиск статьи по названию" aria-describedby="sizing-addon">
                            </div>

                        </form>

                        <br>
                        @foreach($articles as $article)


                            <span class="label label-success">{{$article['created_at']}}</span>
                            <a href="{{ route('article', ['id' => $article['id']]) }}"><h3><b>"{{$article['title']}}"</b></h3></a>
                            <i>Автор: </i><span class="label label-default">{{$article ->author['name']}}</span>
                            <i>Рейтинг: </i><span class="label label-info">{{$article ->rating}}</span>
                            <i>Комментариев: </i><span class="label label-warning">{{$article ->comment->count()}}</span>
                            <i>Категория: </i>
                            <a href="{{route('homeCategory', ['category' => $article['category']])}}">
                                <span class="label label-danger">{{$article ->category}}</span>
                            </a>
                            <hr>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection