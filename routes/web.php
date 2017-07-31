<?php
/*
 * МАРШРУТИЗАЦИЯ САЙТА
 */


# Роут для авторизации
Route::auth();

# Роут для авторизации через VKcom


Route::get('/social_login/{provider}', ['as' => 'VKlogin', 'uses' => 'SocialController@login']);
Route::get('/social_login/callback/{provider}', 'SocialController@callback');



# Главная страница
Route::get('/', 'IndexController@index')->middleware('auth');
# Поиск юзеров
Route::post('/', ['as' => 'searchUsers', 'uses' => 'IndexController@searchUsers']);
# К списку статей
Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
#FAQ
Route::get('/faq', ['as' => 'faq', 'uses' => 'IndexController@faq']);
# К списку сообщений
Route::get('/messages', ['as' => 'messages', 'uses' => 'IndexController@messages']);
# Чат с пользователем (id)
Route::get('/messages/{id}', ['as' => 'messages__user', 'uses' => 'UserController@messages__user']);
# Отправка сообщения пользователю
Route::post('/messages/{id}', ['as' => 'user__message-send', 'uses' => 'UserController@message__send']);
# Фотографии
Route::get('/photos', ['as' => 'photos', 'uses' => 'IndexController@photos']);
# Загрузка фото
Route::put('/photos', ['as' => 'sendPhoto', 'uses' => 'FileController@sendPhoto']);
Route::get('/music', ['as' => 'music', 'uses' => 'IndexController@music']);
Route::get('/video', ['as' => 'video', 'uses' => 'IndexController@video']);
# Кошелекы
Route::get('/cash', ['as' => 'cash', 'uses' => 'IndexController@cash']);
# Поиск статей по названию
Route::post('/home', ['as' => 'home__search', 'uses' => 'HomeController@search']);
# Фильтр статей по категории
Route::get('/home/{category_id}', ['as' => 'homeCategory', 'uses' => 'HomeController@category']);
# Поиск статей по названию в категории
Route::post('/home/{category_id}', ['as' => 'home__search', 'uses' => 'HomeController@search']);
# Форма для создания статьи
Route::get('/article', ['as' => 'formArticle', 'uses' => 'ArticleController@form']);
# Создание статьи
Route::post('/article', ['as' => 'create', 'uses' => 'ArticleController@create']);
# Путь для статьи по id
Route::get('/article/{id}', ['as' => 'article', 'uses' => 'ArticleController@show']);
#Запрос на удаление статьи
Route::get('/article/{id}/delete', ['as' => 'deleteArticle', 'uses' => 'ArticleController@delete']);
#Запрос на редактирование статьи
Route::get('/article/{id}/edit', ['as' => 'editArticle', 'uses' => 'ArticleController@edit']);
# Личный кабинет
Route::get('/lk', ['as' => 'Author', 'uses' => 'UserController@personal']);
# Обновление или создание статуса
Route::post('/lk', ['as' => 'status', 'uses' => 'UserController@status']);
# Загрузка аватара
Route::put('/lk', ['as' => 'avatar', 'uses' => 'FileController@avatar']);
# Редактирование статуса (если уже имеется)
Route::post('/lk/editStatus', ['as' => 'editStatus', 'uses' => 'UserController@editStatus']);
# Post запрос на отправку отредактированной статьи
Route::post('/article/{id}/edit', ['as' => 'editArticle', 'uses' => 'ArticleController@update']);
# Добавление комментария в статью
Route::post('/article/{id}', ['as' => 'addComment', 'uses' => 'ArticleController@add_comment']);
# Управление рейтингом статьи
Route::get('/article/{id}/uprating', ['as' => 'upRating', 'uses' => 'ArticleController@upRating']);
Route::get('/article/{id}/downrating', ['as' => 'downRating', 'uses' => 'ArticleController@downRating']);
Route::get('/article/{id}/resetrating', ['as' => 'resetRating', 'uses' => 'ArticleController@resetRating']);
# Комментарии к статьи
Route::get('/comment/{id}/upcomment', ['as' => 'upComment', 'uses' => 'ArticleController@upComment']);
Route::get('/comment/{id}/downcomment', ['as' => 'downComment', 'uses' => 'ArticleController@downComment']);
Route::get('/comment/{id}/resetcomment', ['as' => 'resetComment', 'uses' => 'ArticleController@resetComment']);

## АДМИНКА

# Главная страница
Route::get('/admin', ['as' => 'admin', 'uses' => 'IndexController@admin']);
# Вывод пользователя по id
Route::get('/user/{id}', ['as' => 'user__profile', 'uses' => 'UserController@user']);

# Запрос на добавление/принятия/удаления в друзья
Route::get('/user/{id}/friend-send', ['as' => 'user__friend-send', 'uses' => 'UserController@friend__send']);
Route::get('/user/{id}/friend-accept', ['as' => 'user__friend-accept', 'uses' => 'UserController@friend_accept']);
Route::get('/user/{id}/friend-decline', ['as' => 'user__friend-decline', 'uses' => 'UserController@friend_decline']);

# Вывод списка друзей
Route::get('/friends', ['as' => 'friends', 'uses' => 'IndexController@friends']);



