<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class LkAuthorController extends Controller
{
    //
    public function show()
    {
       $user_id = \Auth::user()->id;
       $articles = Article::where('user_id', $user_id)->paginate(3);


        return view('lk', compact('articles'));
    }
}
