<?php

namespace App\Models;

use App\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //

    protected $guarded = ['id'];


    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
