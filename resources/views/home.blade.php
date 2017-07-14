@extends('layouts.header')

@section('content1')

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
                            <button type="submit" class="btn btn-default">Поиск</button>
                        </div>
                                {{ csrf_field() }}
                        <input type="text"  name="search" class="form-control" placeholder="Поиск статьи по названию"  aria-label="...">

                    </div>
                    </form>
                    <hr>
             <br>
                    @foreach($articles as $article)


                        <span class="label label-success">{{$article['created_at']}}</span>
                        <a href="{{ route('article', ['id' => $article['id']]) }}"><h3><b>"{{$article['title']}}"</b></h3></a>
                        <i>Автор: </i><span class="label label-default">{{$article ->author['name']}}</span>
                        <i>Рейтинг: </i><span class="label label-info">{{$article ->rating}}</span>
                        <i>Комментариев: </i><span class="label label-warning">{{$article ->comment->count()}}</span>
                        <i>Категория: </i>
                        <a href="{{route('homeCategory', ['category_id' => $article['category_id']])}}">
                          <span class="label label-danger">{{$article->category['name']}}</span>
                        </a>
                        <hr>
                    @endforeach
                        <?php echo $articles->render(); ?>

@endsection
