<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    # Модель для комментариев
    # имя таблицы
    # protected $table = 'comments';
    protected $guarded = ['id'];

    // Обратная связь с моделяю Юзер, т.к. комментарий оставляется пользователем
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Обратная связь с моделяю Статья, т.к. у статьи могут быть комментарии
    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }
    public function ratings() {
        return $this->morphMany(Rating::class,'rating');
    }


    public function vote() {
        return $this->belongsToMany(Comment::class,'rating','user_id','vote');
    }
}
