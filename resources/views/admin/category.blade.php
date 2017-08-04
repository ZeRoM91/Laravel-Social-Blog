@extends('layouts.app')

@section('content')


    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Админ панель</b> </div>

            <div class="panel-body">


                <div class="panel panel-default">
                    <div class="panel-heading">Категории</div>
                    <div class="panel-body">
                        <form class="form" method="post">

                            {{csrf_field()}}
                            <div class="form-group">

                                <label for="exampleInputName2">Добавление категории</label>
                                <br>
                                <input type="text" name="category" class="form-control" placeholder="Введите название">
                            </div>

                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Создать</button>
                        </form>

                        <hr>

                        <form class="form" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <div class="form-group">

                                <label for="exampleInputName2">Удаление категории</label>
                                <br>

                                    @foreach($categories as $category)
                                    <div class="radio">

                                        @if($category->id == 1)
                                            <label>
                                                <input type="radio" name="category" value="{{$category->id}}" disabled>
                                                {{$category->name}}
                                            </label>
                                            @endif
                                            @if($category->id !== 1)
                                    <label>
                                        <input type="radio" name="category" value="{{$category->id}}">
                                      {{$category->name}}
                                    </label>
                                    </div>
                                    @endif
                                        @endforeach


                            </div>
                            {{--<div class="input-group col-md-6">--}}
      {{--<span class="input-group-btn">--}}
        {{--<button class="btn btn-success glyphicon glyphicon-ok" type="submit"></button>--}}

      {{--</span>--}}
                                {{--<input name="name" type="text" class="form-control" placeholder="Название категории">--}}

                            {{--</div>--}}
                            <br>
                            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Удалить</button>
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>



            </div>
        </div>
    </div>


@endsection