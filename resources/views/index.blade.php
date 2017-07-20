@extends('layouts.app')

@section('content')


    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Добро пожаловать !</strong> Если вы впервые на портале, изучить правила вы можете на странице <a
                href="{{route('faq')}}">FAQ</a>
    </div>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Личный кабинет !</strong> В личном кабинете можно управлять списком друзей и просмотреть свои статьи <a
                href="{{route('Author')}}">ЛК</a>
    </div>
@endsection