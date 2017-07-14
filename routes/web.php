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



# Главная
Route::get('/', 'IndexController@index');

# Роут для авторизации
Route::auth();

# В список статей для авторизованых пользователей
Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);



Route::post('/home', ['as' => 'home__search', 'uses' => 'HomeController@search']);

Route::get('/home/{category_id}', ['as' => 'homeCategory', 'uses' => 'HomeController@category']);
# Форма создания

Route::get('/article', ['as' => 'formArticle', 'uses' => 'ArticleController@form']);

# Если метод post то создаем статью
Route::post('/article', ['as' => 'create', 'uses' => 'ArticleController@create']);

Route::get('/lk', ['as' => 'Author', 'uses' => 'lkAuthorController@show']);

Route::get('/article/{id}', ['as' => 'article', 'uses' => 'ArticleController@show']);

Route::get('/article/{id}/delete', ['as' => 'deleteArticle', 'uses' => 'ArticleController@delete']);

Route::get('/article/{id}/edit', ['as' => 'editArticle', 'uses' => 'ArticleController@edit']);

Route::post('/article/{id}/edit', ['as' => 'editArticle', 'uses' => 'ArticleController@update']);


# Добавление комментария
Route::post('/article/{id}', ['as' => 'addComment', 'uses' => 'ArticleController@add_comment']);


Route::get('/article/{id}/uprating', ['as' => 'upRating', 'uses' => 'ArticleController@upRating']);

Route::get('/article/{id}/downrating', ['as' => 'downRating', 'uses' => 'ArticleController@downRating']);

Route::get('/article/{id}/resetrating', ['as' => 'resetRating', 'uses' => 'ArticleController@resetRating']);


/*
 * АДМИНКА
 */

Route::get('/admin', ['as' => 'admin', 'uses' => 'HomeController@admin']);