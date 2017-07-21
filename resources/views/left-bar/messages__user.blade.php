@extends('layouts.app')
@section('content')

<div class="messages__user">
            <div class="grid__block" style="padding: 5px;">

                    <div class="messages__write-block">
                        <div class="panel panel-default">

                            <p>Чат с </p>
                            <div class="message-box">



                            </div>

                        </div>
                    </div>
            </div>
                    <div class="grid__block" style="padding: 5px;">
                        <form   method="post">

                            {{ csrf_field() }}


                            <textarea type="text" name="message3" class="form-control" placeholder="Введите ваше сообщение" rows="4" style="resize: none"></textarea>                    </textarea>
                            <br>
                            <input type="submit" class="btn btn-success" value="Отправить">

                        </form>
                    </div>


</div>

@endsection