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

    public function userName() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function articleName() {
        return $this->belongsTo(Article::class, 'article_id');
    }


}
