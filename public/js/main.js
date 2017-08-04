$( document ).ready(function() {

    $(function() {
        $('#message').submit(function(e) {
            var text = $('#message3').val();
            var $form = $(this);
            $.ajax({
                type: 'POST',
                url: '',
                data: $form.serialize()
            }).done(function() {

                var div = document.createElement("div");  // Create with DOM
                div.innerHTML = text;
                div.className = 'message__to';
                $('.message-box').append(div);
                console.log(text);
            }).fail(function() {
                console.log('fail');
            });
            //отмена действия по умолчанию для кнопки submit
            e.preventDefault();
        });
    });
    $(function () {
        $("#message3").keypress(function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);

            if (code == 13) {
                $("#send").trigger('click');
                $("#message3").val('');
                return false;
            }
        });
    });



    $(function () {
        var wtf = $('.message-box');
        var height = wtf[0].scrollHeight;
        wtf.scrollTop(height);
    });




});