@extends('layouts.app')

@section('content')

    <main class="main">

<div class="grid__block main__block-header">Header

    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Сообщения:</strong> У вас {{$messages__unread->count()}} непрочитанных сообщений
    </div>
</div>
        <div class="grid__block main__block-left-bar">Left bar</div>

        <div class="grid__block"> Section</div>
        <div class="grid__block"> Section</div>
        <div class="grid__block main__block-footer">Footer</div>
    </main>
@endsection