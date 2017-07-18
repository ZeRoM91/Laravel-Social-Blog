<?php

namespace App;


use App\Models\Article;
use App\Models\Friend;
use App\Models\Rating;
use App\Models\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Связь с моделью Статья, т.к. пользователь может быть автором 1..n статей
    public function articles() {
        return $this->hasMany(Article::class);
    }

    // Связь с моделью Рейтинг, т.к. пользователь может оставлять рейтинг к статьям
    public function votes() {
        return $this->hasMany(Rating::class);
    }
    // Связь с моделью Друзья, т.к. у пользователей могут быть друзья
    public function friends() {
        return $this->hasMany(Friend::class,'from_user_id');
    }
    // Связь с моделью Сообщения, т.к. у пользователей могут быть друзья
    public function messages() {
        return $this->hasMany(Message::class,'from_user_id');
    }

//    public function roles() {
//        return $this->belongsToMany(Role::class);
//    }
}
