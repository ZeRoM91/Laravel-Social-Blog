@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Номер статьи: <b>{{$article['id']}}</b> </div>

                    <div class="panel-body">
                        <p>Название статьи: {{$article['title']}}</p>
<p>Дата публикации: {{$article['time']}}</p>
                        <p>Содержание: <br> {{$article['text']}}</p><br>
                        <span><b>Рейтинг статьи: 0 </b></span><button class="btn btn-success">+</button><button class="btn btn-danger">-</button><br>
                        @if(Auth::user()->name != $article['author'])
                        <i>Автор статьи: {{$article['author']}}</i>
                        <br>
                         @else
                            <i>Вы автор данной статьи</i>

                            <hr>

                            <p><b>Другие ваши статьи</b></p>
                        @foreach($articles as $item)

                            <a href="{{route('article',['id' => $item->id])}}"><p>{{$item['title']}}</p></a>

                        @endforeach

                        @endif

                        @if(Auth::user()->name == $article['author'])

                            <hr>
                        <p>Панель управления:</p>
                        <a href="{{route('editArticle',['id' => $article->id])}}" class="btn btn-primary">Редактировать</a>
                        <button class="btn btn-danger" id="article__delete" data-toggle="modal" data-target="#myModal">Удалить</button>

                        @endif
                        <p>Оставить комментарий:</p>
                        <form action="{{route('addComment',['id' => $article->id])}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="article" value="{{$article->id}}" >
                            <input type="hidden" name="author" value="{{Auth::user()->name}}" >
                            <textarea class="form-control" name="comment" cols="90" rows="4" style="resize: none;"></textarea><br>
                            <input type="submit" class="btn btn-default" value="Отправить">

                        </form>

                        <p><b>Комментарии ({{$comments->count()}})</b></p>


                        <hr>

                        @foreach($comments as $comment)
                            <span class="badge badge-primary"><b>{{$comment->author}}:</b></span><span>"{{$comment->comment}}"</span>
                            <hr>
                        @endforeach


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