@extends('layouts.app')
@section('content')

<div class="article__full">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="{{route('homeCategory', ['category_id' => $article['category_id']])}}">{{$article->category['name']}}</a></li>
                               <li class="active">{{$article['id']}} </li>
                        </ol>

                        <div class="well">
                            <span class="glyphicon glyphicon-time"></span><span class="article__date"> {{$article['created_at']}}</span><br>
                      <h3 style="text-align: center;">{{$article['title']}}</h3>
                        <hr>

                        <p>{{$article['text']}}</p>

                            <span class="glyphicon glyphicon-user"></span><a href="{{route('user__profile', ['id' => $article->author])}}"><span>{{$article ->author['name']}}</span></a>



                            @if($article['created_at'] != $article['updated_at'])


                                <i>Обновлена: {{$article['updated_at']}}</i>

                            @endif
                            <br>

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
                            <span><b>Рейтинг статьи: <span class="badge badge-success">+{{$article['rating']}}</span> </b></span>
                            @endif
                            @if($article['rating'] < 0)
                                <span><b>Рейтинг статьи: <span class="badge badge-danger">{{$article['rating']}}</span> </b></span>
                            @endif
                            @if($article['rating'] == 0)
                                <span><b>Рейтинг статьи: <span class="badge badge-static">{{$article['rating']}}</span> </b></span>
                            @endif
                                @if(Auth::user()->id != $article['user_id'])

                                    @if($vote['vote'] === NULL)
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a href="{{route('upRating',['id' => $article->id])}}" ><button class="button button-success">+</button></a>
                                            <a href="{{route('downRating',['id' => $article->id])}}" ><button class="button button-danger">-</button></a></a>
                                        </div>
                                    @endif

                                    @if($vote['vote'] === 1)
                                            <div class="btn-group" role="group" aria-label="...">
                                        <a href="{{route('resetRating',['id' => $article->id])}}"  class="button button-primary" title="Отменить голос">Отменить</a>
                                        <a class="button button-danger" disabled>-</a>
                                            </div>

                                    @endif

                                    @if($vote['vote'] === 0)
                                            <div class="btn-group" role="group" aria-label="...">
                                        <a class="button button-success" disabled>+</a>
                                        <a href="{{route('resetRating',['id' => $article->id])}}"  class="button button-primary" title="Отменить голос">Отменить</a>
                                            </div>

                                    @endif
                                @else

                                    <p> Вы не можете голосовать за свои статьи</p>
                                @endif
                                </div>
                            </div>





                            @if(Auth::user()->id == $article['user_id'])

                                <p>Панель управления:</p>
                                <a href="{{route('editArticle',['id' => $article->id])}}"><button class="button button-primary">Редактировать</button></a>
                                <button class="button button-danger" id="article__delete" data-toggle="modal" data-target="#myModal">Удалить</button>

                            @endif</div>

                        <p>Оставить комментарий:</p>
                        <form action="{{route('addComment',['id' => $article->id])}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="article_id" value="{{$article->id}}" >
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" >
                            <textarea class="form-control" name="comment" cols="90" rows="4" style="resize: none;"></textarea><br>
                            <input type="submit" class="button button-accent" value="Отправить">

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

@endsection