<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFormRequest;
use App\Models\Article;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    //

    public function show($id)
    {

        $text = Article::find($id);


        return view('article', compact('text'));
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
        $author = \Auth::user()->name;
        $check = Article::where('author', $author)->count();


        if ($check) {
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
        $author = \Auth::user()->name;
        $check = Article::where('author', $author)->count();


        if ($check) {

            return view('edit');
        }
        else {
            return "У вас нет прав на редактирование статьи";
        }
    }
}
