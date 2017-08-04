<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    //
    //
    protected $table = 'audios';
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
