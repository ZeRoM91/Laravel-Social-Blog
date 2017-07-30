@extends('layouts.app')

@section('content')


        <?php

        echo Form::open(array('url' => '/photos','method' => 'PUT','files'=>'true'));
        echo 'Выберите файл для загрузки';
        echo Form::file('photo');
        echo Form::submit('Загрузить файл');
        echo Form::close();
        ?>


<h3>Фотографии</h3>
    <hr>


    <div class="grid__block" style="background-image: url({{asset('photos.' . Auth::user()->id . '/')}}); background-size: cover;">



    </div>



@stop