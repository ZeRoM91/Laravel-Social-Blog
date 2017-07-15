@extends('layouts.app')

@section('content')

                    <form action="" method="post">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Категории</button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($articles as $article)
                                <li><a href="{{route('homeCategory', ['category_id' => $article['category_id']])}}">{{$article->category['name']}}</a></li>
                                @endforeach
                                <li><a href="{{route('home')}}">Все категории</a></li>
                            </ul>
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </div>
                                {{ csrf_field() }}
                        <input type="text"  name="search" class="form-control" placeholder="Поиск статьи по названию"  aria-label="...">

                    </div>
                    </form>
                    <hr>
                    <h2>Все подряд</h2>
                     @foreach($articles as $article)

<div class="article">
    <span class="glyphicon glyphicon-time"></span>
    <span class="article__date">{{$article['created_at']}}</span>
    <a href="{{ route('article', ['id' => $article['id']]) }}"><p class="article__title"><b>{{$article['title']}}</b></p></a>

    <span class="glyphicon glyphicon-comment">{{$article ->comment->count()}}</span>
                        <span class="glyphicon glyphicon-user"></span><a href="{{route('user__profile', ['id' => $article->author])}}"><span>{{$article ->author['name']}}</span></a>
                        <i>Рейтинг: </i><span class="label label-info">{{$article ->rating}}</span>

                        <i>Категория: </i>
                        <a href="{{route('homeCategory', ['category_id' => $article['category_id']])}}">
                          <span class="label label-danger">{{$article->category['name']}}</span>
                        </a>
</div>
                        <hr>
                    @endforeach

                        <?php echo $articles->render(); ?>

@endsection
