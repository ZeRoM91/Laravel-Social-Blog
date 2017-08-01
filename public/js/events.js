/*
Список событый для сервера NodeJS:

1. Получение нового сообщения
2. Получение заявки в друзья
3. Перезагрузка главной страницы
4. Уведомление о новой статье
5.

 */
var socket = io('http://localhost:3000');


//1. Получение нового сообщения
socket.on("new-message:App\\Events\\NewMessage", function(message){
    var firstname = message.data.firstname;
    var lastname = message.data.firstname;
    var data = 'Пользователь ' + "<b>" + firstname + ' ' + lastname + "</b>" + ' прислал вам сообщение ';
    var p = document.createElement("p");  // Create with DOM
    var span = document.createElement("span");  // Create with DOM
    p.innerHTML = data;
    span.innerHTML = 'x';
    span.className = 'event-close label label-danger';
    p.className = 'event-elem alert alert-info';
    $(p).append(span);
    $('#event-list').append(p);
    $(".event-close").click(function() {
        $(this).closest('.event-elem').fadeOut('slow');
    });
});

//2. Получение заявки в друзья
socket.on("new-friend:App\\Events\\NewFriend", function(message){
    var name = message.data.name;
    var data = 'Пользователь ' + "<b>" + name + "</b>" + ' хочет добавить вас в друзья ';
    var p = document.createElement("p");  // Create with DOM
    var span = document.createElement("span");  // Create with DOM
    p.innerHTML = data;
    span.innerHTML = 'x';
    span.className = 'event-close label label-danger';
    p.className = 'event-elem alert alert-warning';
    $(p).append(span);
    $('#event-list').append(p);
    $(".event-close").click(function() {
        $(this).closest('.event-elem').fadeOut('slow');
    });

});
//3. Перезагрузка главной страницы
socket.on("new-here:App\\Events\\IndexHere", function(message){
    var firstname = message.data.firstname;
    var lastname = message.data.lastname;
    var data = "<b>" + firstname + ' ' + lastname + "</b>" + ' не давно был на этой странице ';
    var p = document.createElement("p");  // Create with DOM
    var span = document.createElement("span");  // Create with DOM
    p.innerHTML = data;
    span.innerHTML = 'x';
    span.className = 'event-close label label-danger';
    p.className = 'event-elem alert alert-danger';
    $(p).append(span);
    $('#event-list').append(p);
    $(".event-close").click(function() {
        $(this).closest('.event-elem').fadeOut('slow');
    });
});

//4. Уведомление о новой статье
socket.on("new-article:App\\Events\\NewArticle", function(message){
    var article = message.data.title;
    var data = 'Новая статья на портале: ' + "<b>" + article;
    var p = document.createElement("p");  // Create with DOM
    var span = document.createElement("span");  // Create with DOM
    p.innerHTML = data;
    span.innerHTML = 'x';
    span.className = 'event-close label label-danger';
    p.className = 'event-elem alert alert-success';
    $(p).append(span);
    $('#event-list').append(p);
    $(".event-close").click(function() {
        $(this).closest('.event-elem').fadeOut('slow');
    });

});

socket.on("user.private:App\\Events\\ChatMessage", function(message){
    var chat = message.data.content;
    var data = chat;
    var div = document.createElement("div");  // Create with DOM
    div.innerHTML = data;
    div.className = 'message__from';
    $('.message-box').append(div);

});