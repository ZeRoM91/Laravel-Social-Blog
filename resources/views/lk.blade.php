@extends('layouts.app')

@section('content')
    <div class="lk">


        <div class="grid__block lk__avatar"
             style="background-image: url({{isset(Auth::user()->avatar) ? asset('avatars/' . Auth::user()->avatar) : 'https://cdn3.iconfinder.com/data/icons/black-easy/512/538474-user_512x512.png'}}); background-size: cover;">



            <span id="photo"> <span class="glyphicon glyphicon-camera" id="lk__avatar-icon"></span><span id="lk__avatar_hidden-text" type="button" data-toggle="modal" data-target=".bs-example-modal-sm" data-target="#avatar"> Редактировать фото</span>
            </span>


        </div>

        <div class="grid__block lk__block-info">
<h3>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h3>
            <span>{{$status}}</span>

            <hr>
            <form action="{{ isset($status) ? route('editStatus') : ''}}" method="post">
                {{ csrf_field() }}
            <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-success glyphicon glyphicon-ok" type="submit"></button>
      </span>
                <input name="status" type="text" class="form-control" placeholder="{{ isset($status) ? 'Заменить статус' : 'О чем вы думаете...' }}">

            </div><!-- /input-group -->
            </form>

            <hr>



        </div>

        <div class="grid__block ">
            <p>Друзья: {{$friendsCount}}</p>
            <p>Статей: {{$articlesCount}}</p>
            <p>Комментариев: {{$commentsCount}}</p>


        </div>

        <div class="grid__block ">

            <button class="btn btn-default">Редактировать профиль</button>

        </div>
        <div class="grid__block ">

<h3>Записи на стене</h3>
            <hr>

        </div>
        <div class="grid__block ">



        </div>
        <div class="grid__block ">

            <button class="btn btn-default">Редактировать</button>

        </div>
<div class="grid__block lk__block-footer">
                <p><b>Список ваших статей</b></p>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-condensed">
                                    <tr class="danger">
                                        <td>ID статьи</td>
                                        <td>Название статьи</td>
                                        <td>Дата создания</td>

                                    </tr>

                                    @foreach($articles as $article)

                                        <tr>
                                            <td class="active" ><span><b>{{$article['id']}}.</b></span></td>

                                            <td class="active" >
                                                <a href="{{ route('article', ['id' => $article['id']]) }}">
                                                    <span><b>{{$article['title']}}.</b></span>
                                                </a>
                                            </td>

                                            <td class="active" ><span><b>{{$article['created_at']}}.</b></span></td>
                                        </tr>

                                    @endforeach
                                </table>
                            </div>
                            <div class="panel-footer">

                                <?php echo $articles->render(); ?></div>

                        </div>


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