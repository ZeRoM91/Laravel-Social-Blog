@extends('layouts.app')
@section('content')
    <div class="grid-lk">
        <div class="grid__block lk__avatar"
             style="background-image: url({{isset($user->avatar) ? asset('storage/avatars/' . $user->avatar) : '/img/avatar.jpg'}}); background-size: cover;">
            <span id="photo"> <span class="glyphicon glyphicon-camera" id="lk__avatar-icon"></span><span
                        id="lk__avatar_hidden-text" type="button" data-toggle="modal" data-target=".bs-example-modal-sm"
                        data-target="#avatar"> Редактировать фото</span>
            </span>
        </div>
        <div class="grid__block lk__block-info">
            <h3>{{$user->firstname}} {{$user->lastname}}</h3>
            <div class="well">
                @empty(!$user->status)
                    <p>{{$user->status->text}}</p>
                @endempty
            </div>
            <hr>
            <form action="{{ empty(!$user->status->text) ? route('user.status.update') : route('user.status.store')}}"
                  method="post">
                {{ csrf_field() }}
                @empty(!$user->status)
                    {{method_field('PUT')}}
                @endempty
                <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-success glyphicon glyphicon-ok" type="submit"></button>
      </span>
                    <input name="status" type="text" class="form-control"
                           placeholder="{{ empty(!$user->status) ? 'Заменить статус' : 'О чем вы думаете...' }}">
                </div><!-- /input-group -->
            </form>
            <br>
            <hr>
            <a href="{{route('user.edit', $user)}}">
                <button class="btn btn-danger"><span class="glyphicon glyphicon-cog"></span> Редактировать профиль
                </button>
            </a>
        </div>
        <div class="grid__block">
            <h4>Друзья ({{$user->friends->count()}})</h4>
            <hr>
            @foreach($user->friends as $friend)
                <p>{{$friend->firstname}}</p>
            @endforeach
        </div>

        <div class="grid__block lk__block-article">

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
                                <td class="active"><span>{{$article->id}}</span></td>
                                <td class="active">
                                    <a href="{{ route('article.show', $article) }}">
                                        <span>{{$article->title}}</span>
                                    </a>
                                </td>
                                <td class="active"><span>{{$article -> created_at}}</span></td>
                                <td class="active"><span>{{$article -> views}}</span></td>
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
            <form action="{{route('user.blog.store')}}" method="post">
                {{csrf_field()}}
                <textarea class="form__input form-control" placeholder="Добавьте запись..." name="blog" rows="10"
                          style="resize: none;"></textarea>
                <br>
                <button type="submut" class="btn btn-primary">Отправить</button>
            </form>
            <h3>Записи на стене</h3>
            <hr>
            @foreach($blogs as $blog  )
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <img class="img-circle"
                             src="{{isset($user->avatar) ? asset('storage/avatars/' . $user->avatar) : '/img/avatar.jpg'}}">
                        <span>{{$user->firstname}}</span>
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
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         id="avatar">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="grid__block">
                    <h3>Загрузить аватар</h3>
                    <?php
                    echo Form::open(array('url' => 'user', 'method' => 'PUT', 'files' => 'true'));
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
                e.preventDefault();
                $(this).tab('show')
            })
        </script>
@endsection
