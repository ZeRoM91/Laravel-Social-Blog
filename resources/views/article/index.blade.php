@extends('layouts.app')
@section('content')
    <form action="" method="post">
        <div class="input-group">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default">Категории</button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    @foreach($categories as $category)
                        <li><a href="{{route('homeCategory',$category)}}">{{$category->name}}</a></li>
                    @endforeach
                    <li><a href="{{route('article.index')}}">Все категории</a></li>
                </ul>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-search"
                                                                    aria-hidden="true"></span></button>
            </div>
            {{ csrf_field() }}
            <input type="text" name="search" class="form-control" placeholder="Поиск статьи по названию"
                   aria-label="...">
        </div>
    </form>
    <div class="home">
        <div class="btn-toolbar" role="toolbar" aria-label="...">
            <div class="btn-group" role="group" aria-label="...">
                <button class="btn btn-primary" DISABLED>Новые</button>
                <button class="btn btn-default">Старые</button>
                <button class="btn btn-default">Популярные</button>
                <a href="{{route('article.create')}}">
                    <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Добавить новую статью
                    </button>
                </a>
            </div>
        </div>
        @foreach($articles as $article)
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($article->created_at->diffInMinutes() < 1)
                        <span class="article__date">{{$article->created_at->diffInSeconds()}} секунд назад</span><br>
                    @endif
                    @if($article->created_at->diffInMinutes() > 1 && $article->created_at->diffInHours() < 24)
                        <span class="article__date">{{$article->created_at->diffInMinutes()}} минут назад</span><br>
                    @endif
                    @if($article->created_at->diffInHours() > 1 && $article->created_at->diffInDays() < 1)
                        <span class="article__date">{{$article->created_at->diffInMinutes()}} часов назад</span><br>
                    @endif
                    @if($article->created_at->diffInDays() > 1 && $article->created_at->diffInYears() < 1)
                        <span class="article__date">{{$article->created_at->diffInDays()}} дней назад</span><br>
                    @endif
                    @if($article->created_at->diffInDays() > 365)
                        <span class="article__date">{{$article->created_at->diffInYears()}} год(а) назад</span><br>
                    @endif
                    <a href="{{ route('article.show', $article) }}"><h4 class="article__title">
                            <b>{{$article['title']}}</b></h4></a>
                    <br>
                    <a href="{{route('user__profile', ['id' => $article->author])}}">
                        <img src="{{isset($user->avatar) ? asset('storage/avatars/' . $user->avatar) : '/img/avatar.jpg'}}"
                             alt="" class="img-circle ">
                        <span> <b>{{$article->author -> firstname}} {{$article->author -> lastname}}</b></span>
                    </a>
                    <hr>
                    <a href="{{route('homeCategory', ['category_id' => $article['category_id']])}}">
                        <span class="label label-success">{{$article->category['name']}}</span>
                    </a>
                </div>
                <div class="panel-footer" style="color: #666; opacity: .75;">
                    <span class="glyphicon glyphicon-eye-open"></span><span> {{$article ->views}}</span>
                    <span class="glyphicon glyphicon-heart"></span><span> {{$article ->rating}}</span>
                    <span class="glyphicon glyphicon-comment"></span><span> {{$article ->comment->count()}}</span>
                </div>
            </div>
        @endforeach
        <?php echo $articles->render(); ?>
    </div>
@endsection
