@extends('layouts.app')

@section('content')


            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Админ панель</b> </div>

                    <div class="panel-body">


                        <div class="btn-toolbar" role="toolbar" aria-label="...">
                            <div class="btn-group" role="group" aria-label="...">

                                <a href="{{route('admin.category')}}">
                                <button class="btn btn-default"><span class="glyphicon glyphicon-cog"></span> Управление категориями</button>
                                </a>
                            </div>

                        </div>





                    </div>
                </div>
            </div>


@endsection