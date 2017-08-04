@extends('layouts.app')

@section('content')
<div class="grid__block">
    <h3>Редактирование профиля</h3>
    <hr>
    <form method="post">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Имя</label>
                <input type="text" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{Auth::user()->firstname}}">
            </div>
            <div class="form-group">

                <label for="exampleInputPassword1">Фамилия</label>
                <input type="text" name="lastname" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{Auth::user()->lastname}}">
            </div>

            <button type="submit" class="btn btn-default">Отправить</button>
    </form>
</div>
<div class="grid__block">
    <h3>Дополнительная информация</h3>
    <hr>

    <form method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">Телефон</label>
            <input type="text" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{Auth::user()->firstname}}">
        </div>
        <div class="form-group">

            <label for="exampleInputPassword1">Дата рожденияф</label>
            <input type="text" name="lastname" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{Auth::user()->lastname}}">
        </div>

        <button type="submit" class="btn btn-default">Отправить</button>
    </form>
</div>
    @stop