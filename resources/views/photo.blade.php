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
        <div class="photos">
@foreach($photos as $photo)

    <div class="grid__block"
         style="background-image: url({{asset('storage/photos.' . Auth::user()->id . '/' . $photo -> link)}});
                 background-size: cover;">



    </div>

@endforeach

    <?php echo $photos->render(); ?>
</div>


@stop