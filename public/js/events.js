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
    var data = 'Пользователь ' + "<b>" + firstname + ' ' + lastname + "</b>" + ' прислал вам сообщение';
    var li = document.createElement("li");  // Create with DOM
    li.innerHTML = data;
    $('#event-list').append(li);
    $('.newMessage').fadeOut(7000);
});

//2. Получение заявки в друзья
socket.on("new-friend:App\\Events\\NewFriend", function(message){
    var firstname = message.data.firstname;
    var lastname = message.data.firstname;
    var data = 'Пользователь ' + "<b>" + firstname + ' ' + lastname + "</b>" + ' хочет добавить вас в друзья';
    var li = document.createElement("li");  // Create with DOM
    li.innerHTML = data;
    $('#event-list').append(li);
    $('.newFriend').fadeOut(7000);
});
//3. Перезагрузка главной страницы
socket.on("new-here:App\\Events\\IndexHere", function(message){
    var firstname = message.data.firstname;
    var lastname = message.data.lastname;
    var data = "<b>" + firstname + ' ' + lastname + "</b>" + ' не давно был на этой странице';
    var li = document.createElement("li");  // Create with DOM
    li.innerHTML = data;
    $('#event-list').append(li);
    $(li).fadeOut(5000);
});

//4. Уведомление о новой статье
socket.on("new-article:App\\Events\\NewArticle", function(message){
    var article = message.data.title;
    var data = 'Новая статья на портале: ' + "<b>" + article;
    var li = document.createElement("li");  // Create with DOM
    li.innerHTML = data;
    $('#event-list').append(li);
    $(li).fadeOut(5000);
});
