@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         # {{$article['id']}} {{$article['title']}}
                    </div>

                    <div class="panel-body">

                        <p>{{$article['text']}}</p>



                        <div class="well"><p>Дата публикации: {{$article['created_at']}}</p>
                            @if($article['created_at'] != $article['updated_at'])


                                <i>Обновлена: {{$article['updated_at']}}</i>

                            @endif
                            <br> @if(Auth::user()->id == $article['user_id'])
                                <i>Автор статьи: {{$article['user_id']}}</i>
                                <br>

                                <i>Вы автор данной статьи</i>

                                <hr>

                                <p><b>Другие ваши статьи</b></p>

                                <i>Пока в разработке....</i><br>
                                @foreach($articles as $item)

                                <a href="{{route('article',['id' => $item->id])}}"><p>{{$item['title']}}</p></a>

                                @endforeach

                            @endif
                            <span><b>Рейтинг статьи: {{$article['rating']}} </b></span>
                            @if(Auth::user()->id == $article['user_id'])
                            <input type="submit" name="increase" class="btn btn-success" value="+">
                            <input type="submit" name="degrease" class="btn btn-danger" value="-"><br>
                                <p>Панель управления:</p>
                                <a href="{{route('editArticle',['id' => $article->id])}}" class="btn btn-primary">Редактировать</a>
                                <button class="btn btn-danger" id="article__delete" data-toggle="modal" data-target="#myModal">Удалить</button>

                            @endif</div>

                        <p>Оставить комментарий:</p>
                        <form action="{{route('addComment',['id' => $article->id])}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="article_id" value="{{$article->id}}" >
                            <input type="hidden" name="author" value="{{Auth::user()->name}}" >
                            <textarea class="form-control" name="comment" cols="90" rows="4" style="resize: none;"></textarea><br>
                            <input type="submit" class="btn btn-default" value="Отправить">

                        </form>

                        <p ><b>Комментарии ({{$comments->count()}})</b></p>


                        <hr>

                        @foreach($comments as $comment)
                            <i>{{$comment->created_at}}</i><br>
                            <span class="label label-info"><b>{{$comment->author}}:</b></span><span>"{{$comment->comment}}"</span>
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