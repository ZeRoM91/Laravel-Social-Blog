<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    # Модель для сообщений
    # имя таблицы
    # protected $table = 'messages';
    protected $guarded = ['id'];
}
