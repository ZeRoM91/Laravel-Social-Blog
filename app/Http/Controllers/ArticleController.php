<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    //

    public function text($id)
    {

        $text = Article::find($id);


        return view('article', compact('text'));
    }
}