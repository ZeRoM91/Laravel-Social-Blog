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
                    @foreach($categories as $category)
                        <li><a href="{{route('homeCategory', ['category_id' => $category->id])}}">{{$category->name}}</a></li>
                    @endforeach
                    <li><a href="{{route('home')}}">Все категории</a></li>
                </ul>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </div>
            {{ csrf_field() }}
            <input type="text"  name="search" class="form-control" placeholder="Поиск статьи по названию"  aria-label="...">

        </div>
    </form>

    <div class="home">


                     @foreach($articles as $article)

            <div class="panel panel-default">
                <div class="panel-body">



                    <span class="article__date">{{$article['created_at']}}</span><br>



                    <a href="{{ route('article', ['id' => $article['id']]) }}"><h4 class="article__title"><b>{{$article['title']}}</b></h4></a>
                    <br>

                    <a href="{{route('user__profile', ['id' => $article->author])}}">
                        <span class="glyphicon glyphicon-user"></span><span> <b>{{$article->author -> firstname}} {{$article->author -> lastname}}</b></span>
                    </a>
                    <hr>
                    <a href="{{route('homeCategory', ['category_id' => $article['category_id']])}}">
                        <span class="label label-danger"><span class="glyphicon glyphicon-tag"></span>{{$article->category['name']}}</span>
                    </a>

                </div>
                <div class="panel-footer">

                    <span class="glyphicon glyphicon-eye-open" style="color: #61788f;">{{$article ->views}}</span>
                    <span class="glyphicon glyphicon-heart" style="color: #61788f;">{{$article ->rating}}</span>
                    <span class="glyphicon glyphicon-comment" style="color: #61788f;">{{$article ->comment->count()}}</span>
                </div>
            </div>

                    @endforeach

                        <?php echo $articles->render(); ?>
</div>
@endsection
