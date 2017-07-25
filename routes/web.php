<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
 * Header
 */
# Главная страница
Route::get('/', 'IndexController@index')->middleware('auth');


Route::post('/', ['as' => 'searchUsers', 'uses' => 'IndexController@searchUsers']);

# Вывод списка статей
Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

# Вывод списка новостей
Route::get('/news', ['as' => 'news', 'uses' => 'IndexController@news']);

#FAQ
Route::get('/faq', ['as' => 'faq', 'uses' => 'IndexController@faq']);


/*
 * Left-bar
 */

# Непрочитанные сообщения
Route::get('/messages', ['as' => 'messages', 'uses' => 'IndexController@messages']);

# Переписка с пользователем по id
Route::get('/messages/{id}', ['as' => 'messages__user', 'uses' => 'IndexController@messages__user']);
# Отправка сообщения
Route::post('/messages/{id}', ['as' => 'user__message-send', 'uses' => 'UserController@message__send']);
# Роут для авторизации
Route::auth();



# Post запрос статей по названию
Route::post('/home', ['as' => 'home__search', 'uses' => 'HomeController@search']);

# Вывод списка статей по категории
Route::get('/home/{category_id}', ['as' => 'homeCategory', 'uses' => 'HomeController@category']);

# Post запрос статей по названию в категории
Route::post('/home/{category_id}', ['as' => 'home__search', 'uses' => 'HomeController@search']);



# Форма для создания статьи
Route::get('/article', ['as' => 'formArticle', 'uses' => 'ArticleController@form']);

# Если метод post то создаем статью
Route::post('/article', ['as' => 'create', 'uses' => 'ArticleController@create']);

# Личный кабинет
Route::get('/lk', ['as' => 'Author', 'uses' => 'UserController@personal']);

# Путь для статьи по id
Route::get('/article/{id}', ['as' => 'article', 'uses' => 'ArticleController@show']);

#Запрос на удаление статьи
Route::get('/article/{id}/delete', ['as' => 'deleteArticle', 'uses' => 'ArticleController@delete']);

#Запрос на редактирование статьи
Route::get('/article/{id}/edit', ['as' => 'editArticle', 'uses' => 'ArticleController@edit']);

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

/*
 * АДМИНКА
 */
# Главная страница
Route::get('/admin', ['as' => 'admin', 'uses' => 'IndexController@admin']);
//Route::get('/admin/categories', ['as' => 'admin__categories', 'uses' => 'IndexController@a']);

/*
 * Пользователи
 */

# Вывод пользователя по id
Route::get('/user/{id}', ['as' => 'user__profile', 'uses' => 'UserController@user']);

# Запрос на добавление/принятия/удаления в друзья
Route::get('/user/{id}/send-friend', ['as' => 'user__send-friend', 'uses' => 'UserController@friend__send']);
Route::get('/user/{id}/friend-accept', ['as' => 'user__friend-accept', 'uses' => 'UserController@friend_accept']);
Route::get('/user/{id}/friend-decline', ['as' => 'user__friend-decline', 'uses' => 'UserController@friend_decline']);

# Вывод списка друзей
Route::get('/friends', ['as' => 'friends', 'uses' => 'IndexController@friends']);

