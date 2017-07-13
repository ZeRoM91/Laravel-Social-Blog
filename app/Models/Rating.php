<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    // Модель для рейтинга
    // имя таблицы (необязательно, т.к. наследуеться из названия класса)
    // protected $table = 'ratings';

    protected $guarded = ['id'];


    // Обратная связь c моделью Статья, т.к. у статьи есть рейтинг
    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }

    // Обратная связь c моделью Юзер, т.к. пользователи проставляют рейтинг
    public function user() {
        return $this->belongsTo(\User::class, 'user_id');
    }
}
