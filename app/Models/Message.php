<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $guarded = ['id'];
    protected $fillable = ['from_user_id', 'to_user_id', 'message'];

    // Обратная связь с моделяю Юзер, т.к. комментарий оставляется пользователем
    public function userName() {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}
