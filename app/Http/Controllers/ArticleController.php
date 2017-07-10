<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFormRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class ArticleController extends Controller
{
    //

    public function show($id)
    {

        $article = Article::find($id);

        $articles = Article::author()->take(3)->get();




        return view('article', compact('article', 'articles'));
    }


    public function form()
    {
        return view('form');
    }

    public function create(ArticleFormRequest $request)
    {
        $article = Article::create($request->except('_token'));
        return redirect()->route('article', ['id' => $article->id]);
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if (auth()->user()->name == $article->author) {

            $delete__article = Article::find($id);
            $delete__article ->delete();
            return redirect()->route('home');
        }
        else {
            return "У вас нет прав на удаление статьи";
        }
    }

    public function edit($id)
    {
        $article = Article::find($id);

        if (auth()->user()->name == $article->author) {
            return view('form',compact('article'));
        } else {
            return "У вас нет прав на редактирование статьи";
        }
    }


    public function update(ArticleFormRequest $request, $id)
    {
        $article = Article::find($id);

        $article -> title = Input::get('title');

        $article -> text = Input::get('text');

        $article -> save();

        return redirect()->route('article', ['id' => $article->id]);
    }
}
