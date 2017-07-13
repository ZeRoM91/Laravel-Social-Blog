<?php

namespace App;


use App\Models\Article;
use App\Models\Rating;
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
}
