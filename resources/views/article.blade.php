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
                                            <a href="{{route('upRating',['id' => $article->id])}}" ><button class="btn btn-success">+</button></a>
                                            <a href="{{route('downRating',['id' => $article->id])}}" ><button class="btn btn-danger">-</button></a>
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
                                <a href="{{route('editArticle',['id' => $article->id])}}"><button class="btn btn-primary">Редактировать</button></a>
                                <button class="btn btn-danger" id="article__delete" data-toggle="modal" data-target="#myModal">Удалить</button>

                            @endif</div>

                        <p>Оставить комментарий:</p>
                        {{--<form action="{{route('addComment',['id' => $article->id])}}" method="post">--}}
                        <form method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="article_id" value="{{$article->id}}" >
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" >
                            <textarea id="comment" class="form-control" name="comment" cols="90" rows="4" style="resize: none;"></textarea><br>
                            <input type="submit" class="btn btn-success" value="Отправить" id="send" >

                        </form>

                        <p ><b>Комментарии ({{$comments->count()}})</b></p>


                        <hr>
<div id="comment-box">
                        @foreach($comments as $comment)
                            <i>{{$comment->created_at}}</i><br>
                            <span class="badge badge-default"><b>{{$comment->userName['name']}}</b></span><span>"{{$comment->comment}}"</span>
        @if($comment['rating']  > 0)
           <span class="badge badge-success">+{{$comment['rating']}}</span>
        @endif
        @if($comment['rating'] < 0)
           <span class="badge badge-danger">{{$comment['rating']}}</span>
        @endif
        @if($comment['rating'] == 0)
            <span class="badge badge-default">{{$comment['rating']}}</span>
        @endif
        @if(Auth::user()->id != $comment['user_id'])
        @if($vote['vote'] === NULL)
            <div class="btn-group" role="group" aria-label="...">
                <a href="{{route('upComment',['id' => $comment->id])}}" ><button class="label label-success">+</button></a>
                <a href="{{route('downComment',['id' => $comment->id])}}" ><button class="label label-danger">-</button></a>
            </div>
        @endif

        @if($vote['vote'] === 1)
            <div class="btn-group" role="group" aria-label="...">
                <a href="{{route('resetComment',['id' => $comment->id])}}"  class="label label-primary" title="Отменить голос">Отменить</a>
                <a class="label label-danger" disabled>-</a>
            </div>

        @endif

        @if($vote['vote'] === 0)
            <div class="btn-group" role="group" aria-label="...">
                <a class="label label-success" disabled>+</a>
                <a href="{{route('resetComment',['id' => $comment->id])}}"  class="label label-primary" title="Отменить голос">Отменить</a>
            </div>

        @endif

        @endif
                            <hr>
                        @endforeach
                            <script src="http://code.jquery.com/jquery-3.2.1.min.js"
                                    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                                    crossorigin="anonymous"></script>
                            @push('scripts')
                            <script>
                                $('#myModal').on('shown.bs.modal', function () {
                                    $('#myInput').focus()
                                });


                                $('#send').click(function(e) {
                                    var data = {
                                        "comment": $('#comment').val()

                                    };

                                    $.post('', data, function(response) {
                                        $('#comment-box').append("<span>" + data.comment + "</span>");
                                    });

                                    e.preventDefault()
                                });

                            </script>

                            @endpush
                        @endsection
<!--                     <?php //echo $comments->render(); ?>   -->
</div>

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

</div>

