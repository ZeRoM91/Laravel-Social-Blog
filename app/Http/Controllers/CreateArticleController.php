<?php

namespace App\Http\Controllers;
use App\Http\Requests\ArticleFormRequest;
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

    public function create(ArticleFormRequest $request)
    {
        $article = Article::create($request->except('_token'));
        return redirect()->route('article', ['id' => $article->id]);
    }
}
