@extends('layouts.app')
@section('header')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="{{route('formArticle')}}">Article</a></li>
                            <li class="active">{{$article['id']}} </li>
                        </ol>
                    </div>

                    <div class="panel-body">
                      <h3 style="text-align: center;">{{$article['id']}} {{$article['title']}}</h3>
                        <hr>
                        <p>{{$article['text']}}</p>



                        <div class="well"><p>Дата публикации: {{$article['created_at']}}</p>
                            @if($article['created_at'] != $article['updated_at'])


                                <i>Обновлена: {{$article['updated_at']}}</i>

                            @endif
                            <i>Автор статьи: {{$author->name}}</i>
                            <br> @if(Auth::user()->id == $article['user_id'])

                                <br>

                                <i>Вы автор данной статьи</i>

                                <hr>

                                <p><b>Другие ваши статьи</b></p>


                                @foreach($articles as $item)

                                <a href="{{route('article',['id' => $item->id])}}"><p><b>{{$item['id']}}. {{$item['title']}}</b></p></a>

                                @endforeach

                            @endif
<p>Текущий голос:   {{$vote['vote']}}</p>
                            <div class="panel panel-default">
                                <div class="panel-body">


                            @if($article['rating']  > 0)
                            <span><b>Рейтинг статьи: <span class="label label-success">+{{$article['rating']}}</span> </b></span>
                            @endif
                            @if($article['rating'] < 0)
                                <span><b>Рейтинг статьи: <span class="label label-danger">{{$article['rating']}}</span> </b></span>
                            @endif
                            @if($article['rating'] == 0)
                                <span><b>Рейтинг статьи: <span class="label label-default">{{$article['rating']}}</span> </b></span>
                            @endif
                                @if(Auth::user()->id != $article['user_id'])

                                    @if($vote['vote'] === NULL)
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a href="{{route('upRating',['id' => $article->id])}}" class="btn btn-success">+</a>
                                            <a href="{{route('downRating',['id' => $article->id])}}" class="btn btn-danger">-</a>
                                        </div>
                                    @endif

                                    @if($vote['vote'] === 1)
                                            <div class="btn-group" role="group" aria-label="...">
                                        <a href="{{route('resetRating',['id' => $article->id])}}"  class="btn btn-primary" title="Отменить голос">Отменить</a>
                                        <a class="btn btn-danger" disabled>-</a>
                                            </div>

                                    @endif

                                    @if($vote['vote'] === 0)
                                            <div class="btn-group" role="group" aria-label="...">
                                        <a class="btn btn-success" disabled>+</a>
                                        <a href="{{route('resetRating',['id' => $article->id])}}"  class="btn btn-primary" title="Отменить голос">Отменить</a>
                                            </div>

                                    @endif
                                @else

                                    <p> Вы не можете голосовать за свои статьи</p>
                                @endif
                                </div>
                            </div>





                            @if(Auth::user()->id == $article['user_id'])

                                <p>Панель управления:</p>
                                <a href="{{route('editArticle',['id' => $article->id])}}" class="btn btn-primary">Редактировать</a>
                                <button class="btn btn-danger" id="article__delete" data-toggle="modal" data-target="#myModal">Удалить</button>

                            @endif</div>

                        <p>Оставить комментарий:</p>
                        <form action="{{route('addComment',['id' => $article->id])}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="article_id" value="{{$article->id}}" >
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" >
                            <textarea class="form-control" name="comment" cols="90" rows="4" style="resize: none;"></textarea><br>
                            <input type="submit" class="btn btn-default" value="Отправить">

                        </form>

                        <p ><b>Комментарии ({{$comments->count()}})</b></p>


                        <hr>

                        @foreach($comments as $comment)
                            <i>{{$comment->created_at}}</i><br>
                            <span class="label label-info"><b>{{$comment->userName['name']}}:</b></span><span>"{{$comment->comment}}"</span>
                            <hr>
                        @endforeach
                        <?php echo $comments->render(); ?>

                        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content" style="padding: 20px;">
                                   <p>Вы точно хотите удалить статью <b>{{$article['title']}}</b>?
                                    <hr>

                                    <a href="{{route('deleteArticle',['id' => $article->id])}}" class="btn btn-default">Да</a>
                                    <button class="btn btn-warning" data-dismiss="modal">Отмена</button>
                                </div>
                            </div>
                        </div>
                        <script>
                            $('#myModal').on('shown.bs.modal', function () {
                                $('#myInput').focus()
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection