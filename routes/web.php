<?php
/*
 * МАРШРУТИЗАЦИЯ САЙТА
 */
# Роут для авторизации
Route::auth();
# Роут для авторизации через vk.com
Route::get('/social_login/{provider}', ['as' => 'VKlogin', 'uses' => 'SocialController@login']);
Route::get('/social_login/callback/{provider}', 'SocialController@callback');
# Главная страница
Route::get('/', 'IndexController@index')->middleware('auth');
# Поиск юзеров
Route::post('/', ['as' => 'searchUsers', 'uses' => 'IndexController@searchUsers']);
# Управление рейтингом статьи
Route::get('/article/{id}/uprating', 'ArticleController@upRate')->name('article.rate.up');
Route::get('/article/{id}/downrating', 'ArticleController@downRate')->name('article.rate.down');
Route::get('/article/{id}/resetrating', 'ArticleController@resetRate')->name('article.rate.reset');
# Добавление комментария в статью
Route::post('/article/{id}', 'ArticleController@addComment')->name('article.comment.add');
# Комментарии к статьи
Route::resource('article.comment', 'CommentController');

# К списку статей
Route::resource('article', 'ArticleController');

# Обновление или создание статуса

# Добавление блога
Route::post('user.blog', 'UserController@storeBlog')->name('user.blog.store');

Route::post('/user/status', 'UserController@storeStatus')->name('user.status.store');
Route::get('user/deleteStatus', ['as' => 'status.delete', 'uses' => 'LkUserController@delete']);
# Редактирование статуса (если уже имеется)
Route::put('user.editStatus', 'UserController@updateStatus')->name('user.status.update');

# Запрос на добавление/принятия/удаления в друзья
Route::get('user.friend-send', 'UserController@createFriend')->name('user.friend.create');
Route::get('user.friend-accept', 'UserController@storeFriend')->name('user.friend.store');
Route::get('user.friend-decline', 'UserController@destroyFriend')->name('user.friend.destroy');
# К списку сообщений
Route::get('/messages', 'UserController@indexMessages')->name('user.message.index');

# Ресурсная маршрутизация пользователя
Route::resource('user', 'UserController');

#FAQ
Route::get('/faq', ['as' => 'faq', 'uses' => 'IndexController@faq']);

# Чат с пользователем (id)
Route::get('/message/{id}', 'UserController@showMessage')->name('user.message.show');
# Отправка сообщения пользователю
Route::post('/message/{id}', 'UserController@storeMessage')->name('user.message.store');

# Фотографии
Route::get('/photos', ['as' => 'photos', 'uses' => 'IndexController@photos']);
# Загрузка фото
Route::put('/photos', ['as' => 'sendPhoto', 'uses' => 'FileController@sendPhoto']);
# Поиск статей по названию
Route::post('/home', ['as' => 'home__search', 'uses' => 'HomeController@search']);
# Фильтр статей по категории
Route::get('/home/{category_id}', ['as' => 'homeCategory', 'uses' => 'HomeController@category']);
# Поиск статей по названию в категории
Route::post('/home/{category_id}', ['as' => 'home__search', 'uses' => 'HomeController@search']);

## АДМИНКА
# Главная страница
Route::get('/admin', ['as' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/admin/categories', ['as' => 'admin.category', 'uses' => 'AdminController@category']);
Route::post('/admin/categories', ['as' => 'admin.category', 'uses' => 'AdminController@categoryPost']);
Route::delete('/admin/categories', ['as' => 'admin.category', 'uses' => 'AdminController@categoryDelete']);

# Вывод списка друзей
Route::get('/friends', ['as' => 'friends', 'uses' => 'IndexController@friends']);
