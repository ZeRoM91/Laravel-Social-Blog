@extends('layouts.app')

@section('content')
    <div class="box">
    <script>
        $('#myTabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>

<p>Заменить аватар</p>
    <input type="file">
                        <p><b>Данные пользователя</b>
                        <p>Ваш логин: {{Auth::user()->name}}</p>
                       <p>Имя: {{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
                        <p>Ваш email: {{Auth::user()->email}}</p>
                        <p>Аккаунт создан: {{Auth::user()->created_at}}</p>
Тест: <br>
<div class="wall">
    <div class="panel panel-default">
        <div class="panel-body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Заявки в друзья
                <span class="badge">{{$outcomings -> count()}} </span>
            </a>

        </li>
        <li role="presentation">
            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Запросы в друзья
                <span class="badge">{{$incomings -> count()}} </span>
            </a>

        </li>
        <li role="presentation">
            <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Мои друзья
                <span class="badge"> {{$friends -> count()}}</span>
               </a>
        </li>

    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
@foreach($outcomings as $outcoming)
          <button class="btn btn-info"> <span class="glyphicon glyphicon-user"> {{$outcoming -> name}}</span></button> <span class="label label-default">Ожидание</span>
    @endforeach
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
            @foreach($incomings as $incoming)
                <button class="btn btn-warning"> <span class="glyphicon glyphicon-user"> {{$incoming ->name}}</span></button>

                <a href="{{route('user__friend-accept', ['id' => $incoming -> id])}}"><button class="button button-success">Принять</button></a>
                <button class="button button-danger">Отклонить</button>

            @endforeach
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
            @foreach($friends as $friend)
                <button class="btn btn-primary"> <span class="glyphicon glyphicon-success"> {{$friend -> name}}</span></button>

                <a href="{{route('user__friend-decline', ['id' => $friend -> id])}}"><button class="btn btn-danger">Удалить из друзей</button></a>
            @endforeach
        </div>

    </div>

    </div>
    </div>
</div>

                <p><b>Список ваших статей</b></p>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-condensed">
                                    <tr class="info">
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
                            <div class="panel-footer"><?php echo $articles->render(); ?></div>




                        </div>
    </div>
@endsection