<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class CreateArticleController extends Controller
{
    //

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('form');
    }

    public function create()
    {
//        $article = [
//            'title' => $title,
//            'text'  => $text
//        ];

        $create = Article::create(['title' => \Request::get('title'), 'text' => \Request::get('text')]);
        return redirect()->route('article', ['id' => $create->id]);
    }
}
