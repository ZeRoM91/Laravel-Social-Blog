<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Модель для комментариев
    public $timestamps = false;
    protected $guarded = ['id'];

}
