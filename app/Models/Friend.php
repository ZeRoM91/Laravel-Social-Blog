<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    //
    # Модель 'Друзья', для вывода списка друзей у пользователя
    # имя таблицы
    # protected $table = 'friends';
    protected $guarded = ['id'];


    public function users() {
        $this ->belongsToMany(User::class,'from_user_id');
    }
}
