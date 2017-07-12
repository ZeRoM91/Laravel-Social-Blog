<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    // Модель для статей
    // имя таблицы (необязательно, т.к. наследуеться из названия класса)
    // protected $table = 'articles';

    protected $guarded = ['id'];

    // Связь с моделью Комментарий, т.к. пользователь оставляет комментарии
    public function comment() {
        return $this->hasMany(Comment::class);
    }

    // Обратная связь для модели Статья, т.к. пользователя может являеться автором статей
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }





}



