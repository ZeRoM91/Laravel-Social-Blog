<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    //
    # Модель 'Друзья', для вывода списка друзей у пользователя
    # имя таблицы
    # protected $table = 'friends';
    protected $guarded = ['id'];


    public function friend() {
        $this ->belongsTo(User::class,'from_user_id');
    }


}
