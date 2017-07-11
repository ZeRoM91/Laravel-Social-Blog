<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\ArticleFormRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;





class ArticleController extends Controller
{

    # Вывод статьи по id
    public function show($id)
    {
        // поиск статьи по id
        $article = Article::find($id);

        // если это авторская статья то дополниткльно выводим его другие статьи
       // $articles = $article->author()->articles()->whereNot('id', $article->id)->take(3)->get();
        $comments = Article::find($id)->comment()->paginate(5);


        return view('article', compact('article','comments','relations'));
    }

    # Вывод формы
    public function form()
    {
        return view('form');
    }
    # Создание новой статьи
    public function create(ArticleFormRequest $request)
    {
        // создаем статью забирая все данные с формы кроме токена
        $article = Article::create($request->except('_token'));

        return redirect()->route('article', ['id' => $article->id]);
    }
    # Удаление статьи по id
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


    public function rating($id) {







    }

    public function add_comment($id) {



        $article = Article::find($id);

        $comment = Comment::create(['article_id' => Input::get('article_id'), 'comment' => Input::get('comment'),'author' => Input::get('author')]);

        return redirect()->route('article', ['id' => $article->id]);

    }
}
