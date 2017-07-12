<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use App\Http\Requests\ArticleFormRequest;
use App\Models\Article;
use App\Models\Rating;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller
{
    # Вывод статьи по id
    public function show($id)
    {
        // Фильтр поиска статьи по id
        $article = Article::find($id);

        // Фильтр поиска комментария


        // если это авторская статья то дополнительно выводим его другие статьи

        $author = $article->author;
        $articles = $author->articles()->where('id', '<>', $article->id)->take(3)->get();


        $user = auth('web')->user();


        $vote = $user->votes()->where('article_id', $id)->first();

        // Ищем все комментарии по id статьи
        $comments = $article->comment()->paginate(5);
        //dd($vote);
        return view('article', compact('articles', 'comments', 'article', 'author', 'vote'));
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
        if (auth()->user()->id == $article->user_id) {
            $delete__article = Article::find($id);
            $delete__article->delete();
            return redirect()->route('home');
        } else {
            return "У вас нет прав на удаление статьи";
        }
    }

    public function edit($id)
    {
        $article = Article::find($id);
        if (auth()->user()->id == $article->user_id) {
            return view('form', compact('article'));
        } else {
            return "У вас нет прав на редактирование статьи";
        }
    }

    public function update(ArticleFormRequest $request, $id)
    {
        $article = Article::find($id);
        $article->title = Input::get('title');
        $article->text = Input::get('text');
        $article->save();
        return redirect()->route('article', ['id' => $article->id]);
    }

    public function upRating($id)
    {
        # Увеличение рейтинга статьи на единицу
        $article = Article::find($id);
        $article->rating++;
        $article->save();


        $user = auth('web')->user();

        $vote = $user->votes()->firstOrCreate([
            'article_id' => $id
        ]);

        $vote->vote = true;
        $vote->save();

        return redirect()->route('article', ['id' => $article->id]);


    }

    public function downRating($id)
    {

        # Увеличение рейтинга статьи на единицу

        $article = Article::find($id);
        $article->rating--;
        $article->save();


        $user = auth('web')->user();

        $vote = $user->votes()->firstOrCreate([
            'article_id' => $id
        ]);

        $vote->vote = false;
        $vote->save();

        return redirect()->route('article', ['id' => $article->id]);


    }

    public function add_comment($id)
    {
        $article = Article::find($id);
        $comment = Comment::create(['article_id' => Input::get('article_id'), 'comment' => Input::get('comment'), 'user_id' => Input::get('user_id')]);
        return redirect()->route('article', ['id' => $article->id]);
    }
}