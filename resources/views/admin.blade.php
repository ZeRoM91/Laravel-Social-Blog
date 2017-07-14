@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Админ панель блога</b> </div>

                    <div class="panel-body">

                        <a style="text-decoration: none;">
                            <button class="btn btn-success">Редактировать</button>
                        </a>
                        <a style="text-decoration: none;">
                            <button class="btn btn-primary">Редактировать</button>
                        </a>
                        <a style="text-decoration: none;">
                            <button class="btn btn-info">Редактировать</button>
                        </a>
                        <a style="text-decoration: none;">
                            <button class="btn btn-warning">Редактировать</button>
                        </a>
                        <a style="text-decoration: none;">
                            <button class="btn btn-danger">Редактировать</button>
                        </a>
                        <hr>


                        <table class="table table-bordered">
                            <caption>Список категорий</caption>
                            <tr class="active">
                                <th>ID категории</th>
                                <th>Название категории</th>
                                <th>Заменить</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Без категории</td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger">Удалить</button>
                                            <button class="btn btn-success">Обновить</button>
                                        </div>
                                        <input type="text" class="form-control" aria-label="...">

                                    </div>

                                </td>
                            </tr>
                        </table>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection