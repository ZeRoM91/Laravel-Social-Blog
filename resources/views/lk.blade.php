@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Личный кабинет</b> </div>

                    <div class="panel-body">
                        <p><b>Данные пользователя</b>
                        <p>Ваш логин: {{Auth::user()->name}}</p>

                        <p>Ваш email: {{Auth::user()->email}}</p>
                        <p>Аккаунт создан: {{Auth::user()->created_at}}</p>
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
                </div>
            </div>
        </div>
    </div>
@endsection