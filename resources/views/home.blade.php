@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Список статей</div>

                <div class="panel-body">


                    @foreach($articles as $article)

                        <h1>{{$article['title']}}</h1>


                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
