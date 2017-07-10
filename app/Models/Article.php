<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // имя таблицы
    // protected $table = 'articles';
    public $timestamps = false;
    protected $guarded = ['id'];


    public function scopeAuthor ($query) {

        $author = \Auth::user()->name;
        return $query -> where('author', $author);
    }

}
