@extends('layouts.app')
@section('content')
    <div class="btn-toolbar" role="toolbar" aria-label="...">
        <div class="btn-group" role="group" aria-label="...">
            <a href="{{route('admin.category')}}">
                <button class="btn btn-default"><span class="glyphicon glyphicon-cog"></span> Управление категориями
                </button>
            </a>
        </div>
    </div>
@endsection