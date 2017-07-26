@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Chat Box</div>
                    <div class="panel-body" style="height: 350px; overflow-y: auto" id="content">
                    </div>
                    <div class="panel-footer">
                        <div class="input-group">
                            <input type="text" class="form-control" id="input" placeholder="Enter your message...">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="send">Send</button>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#send').on('click', function () {
            let message = $('#input').val();
            $('#input').val('');
            if (message != '') {
                $.ajax({
                    url: 'comment',
                    type: 'POST',
                    dataType: 'json',
                    data: {message: message},
                });
            }
        });

        Echo.private('chat-room')
            .listen('ChatEvent', (e) => {
                console.log(e);
                $('#content').append(`<div class="well">${e.message}</div>`);
            });
    </script>
@endsection