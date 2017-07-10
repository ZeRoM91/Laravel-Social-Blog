@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Номер статьи: <b>{{$text['id']}}</b> </div>

                    <div class="panel-body">
                        <p>Название статьи: {{$text['title']}}</p>
<p>Дата публикации: {{$text['time']}}</p>
                        <p>Содержание: <br> {{$text['text']}}</p><br>

                        @if(Auth::user()->name != $text['author'])
                        <i>Автор статьи: {{$text['author']}}</i>
                        <br>
                         @else
                            <i>Вы автор данной статьи</i>
                        @endif

                        @if(Auth::user()->name == $text['author'])

                            <hr>
                        <p>Панель управления:</p>
                        <a href="" class="btn btn-primary">Редактировать</a>
                        <button class="btn btn-danger" id="article__delete" data-toggle="modal" data-target="#myModal">Удалить</button>

                        @endif
                        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content" style="padding: 20px;">
                                   <p>Вы точно хотите удалить статью <b>{{$text['title']}}</b>?
                                    <hr>

                                    <a href="{{route('deleteArticle',['id' => $text->id])}}" class="btn btn-default">Да</a>
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