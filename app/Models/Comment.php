<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    # Модель для комментариев
    # имя таблицы
    # protected $table = 'comments';
    protected $guarded = ['id'];


    # Фильтр по статье

    public function scopeArticle($query, $id) {
        return $query->where('article_id', $id);
    }


}
