<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // Модель для статей
    // имя таблицы
    // protected $table = 'articles';

    protected $guarded = ['id'];


    public function scopeAuthor($query) {

        $author = \Auth::user()->name;
        return $query -> where('author', $author);
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

}
