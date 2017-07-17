@extends('layouts.app')

@section('content')






        <table class="table table-bordered">

        </table>



    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"><h2>Список пользователей</h2></div>



        <table class="table table-hover">
            <thead class="active">
                <th>ID</th>
                <th>Пользователь</th>
                <th>Участник с:</th>
                <th>Статус</th>

            </thead>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('user__profile',['id' => $user->id])}}">{{$user->name}}</a></td>
                    <td>{{$user->created_at}}</td>
                    @if($user->remember_token != NULL)
                    <td class="text-success">Онлайн</td>
                    @else
                    <td class="text-danger">Оффлайн</td>
                        @endif

                </tr>
            @endforeach
        </table>
    </div>

@endsection