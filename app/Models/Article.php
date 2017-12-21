<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    // Модель для статей
    // имя таблицы необязательно, т.к. наследуеться из названия класса
    //protected $table = 'articles';
    protected $guarded = ['id','rating'];
    // Связь с моделью Комментарий, т.к. у статьи много комментариев
    public function comment() {
        return $this->hasMany(Comment::class);
    }
    // Обратная связь для модели Статья, т.к. пользователь являеться автором статьи
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Обратная связь для модели Категория, т.к. статья пренадлежит какой-либо категории
    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function ratings() {
        return $this->morphMany(Rating::class,'rating');
    }
}



