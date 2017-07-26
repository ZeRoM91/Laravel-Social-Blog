@extends('layouts.app')

@section('content')

    <main class="main">

<div class="grid__block main__block-header">

    <h2>Привет, {{Auth::user()->firstname}}!</h2>

    <hr>
</div>
        <div class="grid__block main__block-left-bar">Left bar</div>
        <div class="grid__block">
            <h6>Пользователи на данной странице</h6>


        </div>
        <div class="grid__block"> Section</div>
        <div class="grid__block main__block-footer">Footer</div>
    </main>




@endsection