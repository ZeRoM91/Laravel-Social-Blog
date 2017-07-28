<?php

namespace App;


use App\Models\Article;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Status;
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
        'name', 'email', 'password','firstname','lastname',
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
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

// Связь с моделью Сообщение, т.к. пользователь может отправлять много сообщений
    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id');
    }
    // Связь с моделью Рейтинг, т.к. пользователь может оставлять рейтинг к статьям
    public function votes()
    {
        return $this->hasMany(Rating::class);
    }


    public function sendFriend()
    {
        return $this->belongsToMany(User::class, 'friends', 'from_user_id', 'to_user_id')->withPivot('status');

    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'from_user_id', 'to_user_id')
            ->wherePivot('status', true);
    }

    public function incomingRequests()
    {
        return $this->belongsToMany(User::class, 'friends', 'to_user_id', 'from_user_id')
            ->wherePivot('status', false);
    }

    public function outcomingRequests()
    {
        return $this->belongsToMany(User::class, 'friends', 'from_user_id', 'to_user_id')
            ->wherePivot('status', false);
    }

// Связь с моделью Сообщение, т.к. пользователь может отправлять много сообщений
    public function messages()
    {
        return $this->hasMany(Message::class,'from_user_id');
    }


    public function status()
    {
        return $this->hasOne(Status::class,'user_id');
    }
    public function messagesTo()
    {
        return $this->hasMany(Message::class,'to_user_id');
    }

    public function scopeHasMessages($query)
    {
        return $query->whereHas('messages');
    }
}