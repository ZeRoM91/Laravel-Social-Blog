$( document ).ready(function() {

    $(function () {
        var wtf = $('.message-box');
        var height = wtf[0].scrollHeight;
        wtf.scrollTop(height);
    });

});