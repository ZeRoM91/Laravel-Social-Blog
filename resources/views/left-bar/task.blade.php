@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"><h2>Список задач</div>
    <table class="table table-hover">
        <thead class="active">
<th>#</th>
<th>Название</th>
<th>Статус</th>
<th>Время</th>

        </thead>
        <tr>
            <td>1</td>
            <td>Без названия</td>
            <td>В работе</td>
            <td>{{date("Y:m:d H:m:s")}}</td>
        </tr>
    </table>
    </div>


    @stop