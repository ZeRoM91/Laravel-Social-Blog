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
                        @foreach($articles as $article)

                            <span><b>#{{$article['id']}}.</b></span>
                            <span>{{$article['created_at']}}</span>
                            <a href="{{ route('article', ['id' => $article['id']]) }}"><p><b>{{$article['title']}}</b></p></a>

                            <hr>
                        @endforeach
                        <?php echo $articles->render(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection