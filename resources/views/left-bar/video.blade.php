@extends('layouts.app')

@section('content')


    <?php

    echo Form::open(array('url' => '/video','method' => 'PUT','files'=>'true'));
    echo 'Выберите файл для загрузки';
    echo Form::file('video');
    echo Form::submit('Загрузить файл');
    echo Form::close();
    ?>


    <h3>Видео</h3>
    <hr>

        @foreach($videos as $video)
            <div class="grid__block">
            <p>{{$video -> name}}</p>
            <video width="320" height="240" controls>
                <source src="{{asset('storage/' . Auth::user()->id . '/videos/' . $video -> link)}}">
                Your browser does not support the video tag.
            </video>

            </div>
        @endforeach




@stop