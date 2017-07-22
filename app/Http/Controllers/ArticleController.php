<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\ArticleFormRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # Вывод статьи по id
    public function show($id)
    {
        // Фильтр поиска статьи по id
        $article = Article::find($id);
        // если это авторская статья то дополнительно выводим его другие статьи
        // Выводим так: Ищем автора статьи -> у автора находим другие статьи -> выводим
        // все кроме этой -> но не более 3.
        $articles = $article->author->articles->where('id', '<>', $article->id)->take(3);
        // Выгрузка статуса голоса пользователя для текущей статьи
        $user = auth('web')->user();
        $vote = $user->votes()->where('article_id', $id)->first();
        // Выводим все комментарии по id статьи
        $comments = $article->comment;
        // Увеличиваем просмотры статьи на единицу
        $article -> views++;
        $article->save();
        return view('article', compact('articles', 'comments', 'article', 'vote'));



    }
    # Вывод формы
    public function form()
    {
        $categories = Category::all();
        return view('form',compact('categories'));
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
            return view('errors.access');
        }
    }
    # Редактирование текущей статьи
    public function edit($id)
    {
        // Фильтр поиска статьи по id
        $article = Article::find($id);
        $categories = Category::all();
        // Если авторизованный пользователь и есть автор
        if (auth()->user()->id == $article->user_id) {
            // Выводим форму для редактирования
            return view('form', compact('article','categories'));
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
        $article->category_id = \Request::get('category_id');

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
    public function upComment($id)
    {
        // Фильтр поиска статьи по id
        $comment = Comment::find($id);

        # Увеличение рейтинга статьи на единицу
        $comment->rating++;
        $comment->save();

        // Создание статуса голоса пользователя для текущей статьи
        $user = auth('web')->user();
        $vote = $user->votes()->firstOrCreate([
            'article_id' => $comment->article_id,
            'comment_id' => $id

        ]);

        // Если проголосовал за: true
        $vote->vote = true;
        $vote->save();

        // Редирект на текущюю статью
        return redirect()->route('article', ['id' => $comment->article_id]);
    }
    # Изменение рейтинга статьи: -
    public function downComment($id)
    {


        // Фильтр поиска статьи по id
        $comment = Comment::find($id);

        # Увеличение рейтинга статьи на единицу
        $comment->rating--;
        $comment->save();

        // Создание статуса голоса пользователя для текущей статьи
        $user = auth('web')->user();
        $vote = $user->votes()->firstOrCreate([
            'article_id' => $comment->article_id,
            'comment_id' => $id
        ]);

        // Если проголосовал за: true
        $vote->vote = false;
        $vote->save();

        // Редирект на текущюю статью
        return redirect()->route('article', ['id' => $comment->article_id]);
    }
    public function resetComment($id)
    {
        $comment = Comment::find($id);

        # Уменьшение рейтинга статьи на единицу

        // Создание статуса голоса пользователя для текущей статьи
        $user = auth('web')->user();

        $vote = $user->votes()->where('comment_id', $id)->first();

        $comment->rating += $vote->vote ? -1 : 1;
        $comment->save();

        $vote->delete();

        // Редирект на текущюю статью
        return redirect()->route('article', ['id' => $comment->article_id]);
    }
}