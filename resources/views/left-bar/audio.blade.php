@extends('layouts.app')

@section('content')


    <?php

    echo Form::open(array('url' => '/audio','method' => 'PUT','files'=>'true'));
    echo 'Выберите файл для загрузки';
    echo Form::file('audio');
    echo Form::submit('Загрузить файл');
    echo Form::close();
    ?>


    <h3>Музыка</h3>
    <hr>
<div class="grid__block" style="max-height: 400px; overflow-y: scroll;">

    <h4>Плейлист</h4>
    <hr>
        @foreach($audios as $audio)

    <p>{{$audio -> name}}</p>
            <audio controls="controls">

                Ваш браузер не поддерживает <code>audio</code> элемент.
                <source  name="Song 1" src="{{asset('storage/' . Auth::user()->id . '/audios/' . $audio -> link)}}" type="audio/wav">

            </audio>


        @endforeach

</div>


@stop