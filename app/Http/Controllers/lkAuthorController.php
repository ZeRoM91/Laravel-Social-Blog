<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class LkAuthorController extends Controller
{
    //
    public function show()
    {
       $author = \Auth::user()->name;
       $articles = Article::where('author', $author)->paginate(3);


        return view('lk', compact('articles'));
    }
}
