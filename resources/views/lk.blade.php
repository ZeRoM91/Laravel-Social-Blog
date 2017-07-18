@extends('layouts.app')

@section('content')

    <img src="http://findicons.com/files/icons/61/dragon_soft/256/user.png" alt="..." class="img-thumbnail">
<p>Заменить аватар</p>
    <input type="file">
                        <p><b>Данные пользователя</b>
                        <p>Ваш логин: {{Auth::user()->name}}</p>

                        <p>Ваш email: {{Auth::user()->email}}</p>
                        <p>Аккаунт создан: {{Auth::user()->created_at}}</p>

    <h2>Список друзей</h2>


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

@endsection