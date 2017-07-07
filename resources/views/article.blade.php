@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Номер статьи: <b>{{$text['id']}}</b> </div>

                    <div class="panel-body">

{{$text['text']}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection