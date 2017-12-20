@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Создание новой статьи</div>
                <div class="panel-body">
                    <form action="{{route('article.update', $article)}}" method="post">
                        <div class="form-group">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <label for="title">Заголовок</label>
                            <input type="text" class="form__input form-control" placeholder="Введите заголовок статьи" name="title" required
                                   value="{{$article->title}}">
                        </div>
                        <div class="form-group">
                            <label for="text">Текст статьи</label>
                            <textarea class="form__input form-control" placeholder="Введите текст статьи" name="text" rows="10" style="resize: none;">{{$article->text}}</textarea>
                            <input type="text"  name="user_id" value="{{ Auth::user()->id }}" hidden>
                        </div>
                        <label for="category">Категория статьи</label>
                        <select class="form-control" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                            @endforeach
                        </select>
                        <br>
                        <input type="submit" class="btn btn-success" value="Обновить">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
@endsection
