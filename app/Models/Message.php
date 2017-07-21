<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id'];
    // Обратная связь с моделяю Юзер, т.к. комментарий оставляется пользователем
    public function userFrom()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
    public function userTo()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
    public function scopeUnread($query)
    {
        return $query->where('status', false);
    }
}
