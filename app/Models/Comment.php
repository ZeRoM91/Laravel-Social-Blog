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
    public function userName() {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Обратная связь с моделяю Статья, т.к. у статьи могут быть комментарии
    public function articleName() {
        return $this->belongsTo(Article::class, 'article_id');
    }


}
