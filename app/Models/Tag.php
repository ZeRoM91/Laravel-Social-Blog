<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    // Модель для тегов
    // имя таблицы (необязательно, т.к. наследуеться из названия класса)
    // protected $table = 'tags';
    protected $guarded = ['id'];
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }



}
