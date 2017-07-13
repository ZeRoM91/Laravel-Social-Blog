<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\ArticleFormRequest;
use App\Models\Article;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller
{
    # Вывод статьи по id
    public function show($id)
    {
        // Фильтр поиска статьи по id
        $article = Article::find($id);

        // если это авторская статья то дополнительно выводим его другие статьи
        $author = $article->author;
        $articles = $author->articles()->where('id', '<>', $article->id)->take(3)->get();

        // Выгрузка статуса голоса пользователя для текущей статьи
        $user = auth('web')->user();
        $vote = $user->votes()->where('article_id', $id)->first();

        // Выводим все комментарии по id статьи
        $comments = $article->comment()->paginate(5);
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
        // Фильтр поиска статьи по id
        $article = Article::find($id);

        // Если авторизованный пользователь и есть автор
        if (auth()->user()->id == $article->user_id) {
            $delete__article = Article::find($id);
            $delete__article->delete();
            return redirect()->route('home');
        }

        // Иначе возвращаем исключение
        else {
            return "У вас нет прав на удаление статьи";
        }
    }

    # Редактирование текущей статьи
    public function edit($id)
    {
        // Фильтр поиска статьи по id
        $article = Article::find($id);

        // Если авторизованный пользователь и есть автор
        if (auth()->user()->id == $article->user_id) {

            // Выводим форму для редактирования
            return view('form', compact('article'));
        }
        // Иначе возвращаем исключение
        else {
            return "У вас нет прав на редактирование статьи";
        }
    }

    # Форма редактирования статьи по id
    public function update(ArticleFormRequest $request, $id)
    {
        // Фильтр поиска статьи по id
        $article = Article::find($id);

        // Забираем значения с Input form'ы
        $article->title = Input::get('title');
        $article->text = Input::get('text');
        $article->category = \Request::get('category');

        // Записываем изменения
        $article->save();
        // Редирект на текущюю статью
        return redirect()->route('article', ['id' => $article->id]);
    }

    # Вывод комментариев к статье
    public function add_comment($id)
    {
        // Фильтр поиска статьи по id
        $article = Article::find($id);

        // Создание комментария для статьи
        $comment = Comment::create([
            'article_id' => Input::get('article_id'),
            'comment'    => Input::get('comment'),
            'user_id'    => Input::get('user_id')
        ]);
        // Редирект на текущюю статью
        return redirect()->route('article', ['id' => $article->id]);
    }
    # Изменение рейтинга статьи: +
    public function upRating($id)
    {
        // Фильтр поиска статьи по id
        $article = Article::find($id);

        # Увеличение рейтинга статьи на единицу
        $article->rating++;
        $article->save();

        // Создание статуса голоса пользователя для текущей статьи
        $user = auth('web')->user();
        $vote = $user->votes()->firstOrCreate([
            'article_id' => $id
        ]);

        // Если проголосовал за: true
        $vote->vote = true;
        $vote->save();

        // Редирект на текущюю статью
        return redirect()->route('article', ['id' => $article->id]);
    }
    # Изменение рейтинга статьи: -
    public function downRating($id)
    {
        // Фильтр поиска статьи по id
        $article = Article::find($id);

        # Уменьшение рейтинга статьи на единицу
        $article->rating--;
        $article->save();

        // Создание статуса голоса пользователя для текущей статьи
        $user = auth('web')->user();
        $vote = $user->votes()->firstOrCreate([
            'article_id' => $id
        ]);

        // Если проголосовал против: false
        $vote->vote = false;
        $vote->save();

        // Редирект на текущюю статью
        return redirect()->route('article', ['id' => $article->id]);
    }

    public function resetRating($id)
    {
        $article = Article::find($id);

        # Уменьшение рейтинга статьи на единицу

        // Создание статуса голоса пользователя для текущей статьи
        $user = auth('web')->user();

        $vote = $user->votes()->where('article_id', $id)->first();

        $article->rating += $vote->vote ? -1 : 1;
        $article->save();

        $vote->delete();

        // Редирект на текущюю статью
        return redirect()->route('article', ['id' => $article->id]);
    }
}