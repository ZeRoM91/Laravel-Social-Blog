<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    // Модель для статей
    // имя таблицы
    // protected $table = 'articles';

    protected $guarded = ['id'];


//    public function scopeAuthor($query) {
//
//        $user_id = \Auth::user()->id;
//        return $query -> where('user_id', $user_id);
//    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }




}



