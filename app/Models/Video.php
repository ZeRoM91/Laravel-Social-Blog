<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Video extends Model
{
    //
    protected $table = 'videos';
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
