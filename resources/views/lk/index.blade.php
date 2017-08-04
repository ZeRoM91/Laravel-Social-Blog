@extends('layouts.app')
@section('content')
    <div class="lk">
        <div class="grid__block lk__avatar"
             style="background-image: url({{isset(Auth::user()->avatar) ? asset('storage/avatars/' . Auth::user()->avatar) : '/img/avatar.jpg'}}); background-size: cover;">
            <span id="photo"> <span class="glyphicon glyphicon-camera" id="lk__avatar-icon"></span><span id="lk__avatar_hidden-text" type="button" data-toggle="modal" data-target=".bs-example-modal-sm" data-target="#avatar"> Редактировать фото</span>
            </span>
        </div>
        <div class="grid__block lk__block-info">
<h3>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h3>
            <div class="well">

            @if(isset($status) )


                    @if(Auth::user()->status->created_at->diffInMinutes() <= 1)
                        <span class="article__date">{{Auth::user()->status->created_at->diffInSeconds()}} секунд назад</span><br>
                    @endif

                    @if(Auth::user()->status->created_at->diffInMinutes() >= 1 && Auth::user()->status->created_at->diffInHours() < 24)
                        <span class="article__date">{{Auth::user()->status->created_at->diffInMinutes()}} минут назад</span><br>

                    @endif

                    @if(Auth::user()->status->created_at->diffInHours() >= 1 && Auth::user()->status->created_at->diffInDays() < 1)
                        <span class="article__date">{{Auth::user()->status->created_at->diffInMinutes()}} часов назад</span><br>

                    @endif
                    @if(Auth::user()->status->created_at->diffInDays() >= 1 && Auth::user()->status->created_at->diffInYears() < 1)
                        <span class="article__date">{{Auth::user()->status->created_at->diffInDays()}} дней назад</span><br>

                    @endif

                    @if(Auth::user()->status->created_at->diffInDays() > 365)
                        <span class="article__date">{{Auth::user()->status->created_at->diffInYears()}} год(а) назад</span><br>

                    @endif
                
                    <p>{{Auth::user()->status->status}}</p>
                <a href="{{route('status.delete')}}">
                    <button class="btn btn-danger glyphicon glyphicon-remove" type="submit"></button>
                </a>
            @endif
            </div>
            <hr>
            <form action="{{ isset($status) ? route('editStatus') : '/lk/status'}}" method="post">
                {{ csrf_field() }}

            <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-success glyphicon glyphicon-ok" type="submit"></button>

      </span>
                <input name="status" type="text" class="form-control" placeholder="{{ isset($status) ? 'Заменить статус' : 'О чем вы думаете...' }}">

            </div><!-- /input-group -->
            </form>
            <br>

            <hr>



        </div>

        <div class="grid__block ">
            <p>Друзья: {{$friendsCount}}</p>
            <p>Статей: {{$articlesCount}}</p>
            <p>Комментариев: {{$commentsCount}}</p>


        </div>


        <div class="grid__block">
            <a href="{{route('lk.edit')}}">
            <button class="btn btn-danger"><span class="glyphicon glyphicon-cog"></span> Редактировать профиль</button>
            </a>
        </div>

        <div class="grid__block">
            <p><b>Список ваших статей</b></p>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-condensed">
                        <tr class="success">
                            <td>ID статьи</td>
                            <td>Название статьи</td>
                            <td>Дата создания</td>
                            <td>Просмотров</td>
                        </tr>

                        @foreach($articles as $article)

                            <tr>
                                <td class="active" ><span>{{$article->id}}</span></td>

                                <td class="active" >
                                    <a href="{{ route('article', ['id' => $article -> id]) }}">
                                        <span>{{$article->title}}</span>
                                    </a>
                                </td>

                                <td class="active" ><span>{{$article -> created_at}}</span></td>
                                <td class="active" ><span>{{$article -> views}}</span></td>
                            </tr>

                        @endforeach
                    </table>
                </div>
                <div class="panel-footer">

                    <?php echo $articles->render(); ?></div>

            </div>


        </div>
        <div class="grid__block lk__block-footer">

<h3>Добавить запись</h3>
            <form action="{{route('lk.blog')}}" method="post">
    {{csrf_field()}}
            <textarea class="form__input form-control" placeholder="Добавьте запись..." name="blog" rows="10" style="resize: none;"></textarea>
                <br>
                <button type="submut" class="btn btn-primary">Отправить</button>
            </form>
            <h3>Записи на стене</h3>
            <hr>

            @foreach($blogs as $blog  )
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <img class="img-circle" src="{{isset(Auth::user()->avatar) ? asset('storage/avatars/' . Auth::user()->avatar) : '/img/avatar.jpg'}}">
<span>{{Auth::user()->firstname}}</span>

                    </div>
                    <div class="panel-body">
                <p>{{$blog -> text}}</p>

                    </div>
                    <div class="panel-footer">

                        @if($blog->created_at->diffInMinutes() <= 1)
                            <span>{{$blog->created_at->diffInSeconds()}} секунд назад</span><br>
                        @endif

                        @if($blog->created_at->diffInMinutes() >= 1 && $blog->created_at->diffInHours() < 24)
                            <span>{{$blog->created_at->diffInMinutes()}} минут назад</span><br>

                        @endif

                        @if($blog->created_at->diffInHours() >= 1 && $blog->created_at->diffInDays() < 1)
                            <span>{{$blog->created_at->diffInMinutes()}} часов назад</span><br>

                        @endif
                        @if($blog->created_at->diffInDays() >= 1 && $blog->created_at->diffInYears() < 1)
                            <span>{{$blog->created_at->diffInDays()}} дней назад</span><br>

                        @endif

                        @if($blog->created_at->diffInDays() > 365)
                            <span>{{$blog->created_at->diffInYears()}} год(а) назад</span><br>

                        @endif


                    </div>
                </div>
                @endforeach

            <?php echo $blogs->render(); ?>
         </div>


    </div>


    {{--MODAL--}}
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="avatar">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="grid__block">

                    <h3>Загрузить аватар</h3>
                    <?php

                    echo Form::open(array('url' => '/lk','method' => 'PUT','files'=>'true'));
                    echo 'Выберите файл для загрузки';
                    echo Form::file('avatar');
                    echo Form::submit('Загрузить файл');
                    echo Form::close();
                    ?>
            </div>
        </div>
    </div>

    <script>
        $('#myTabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
@endsection