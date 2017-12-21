<?php
namespace App\Http\Controllers;
use App\Http\Requests\ArticleFormRequest;
use App\Events\NewArticle;
use App\Traits\ArticleConstructorTrait;
use Illuminate\Http\Request;
class ArticleController extends Controller
{
    use ArticleConstructorTrait;

    public function index()
    {
        // Выводим список статей
        $articles = $this->article->orderBy('created_at','desc') ->paginate(5);
        $categories = $this->category->all();

        return view('article.index', compact('articles','categories'));
    }
    # Вывод статьи по id
    public function show($id)
    {
        // Фильтр поиска статьи по id
        $article = $this->article->find($id);
        // если это авторская статья то дополнительно выводим его другие статьи
        // Выводим так: Ищем автора статьи -> у автора находим другие статьи -> выводим
        // все кроме этой -> но не более 3.
        $articles = $article->author->articles->where('id', '<>', $article->id)->take(3);
        // Выгрузка статуса голоса пользователя для текущей статьи
        $user = $this->user->auth();
        $vote = $user->votes()->where('article_id', $id)->first();
        $votes = $user->votes;
        // Выводим все комментарии по id статьи
        $comments = $article->comment;
        // Увеличиваем просмотры статьи на единицу
        $article->views++;
        $article->save();
        return view('article.show', compact('articles', 'comments', 'article', 'vote','votes'));
    }
    # Вывод формы
    public function create()
    {
        $categories = $this->category->all();
        return view('article.create',compact('categories'));
    }
    # Создание новой статьи
    public function store(ArticleFormRequest $request)
    {
        // создаем статью забирая все данные с формы кроме токена
        $article = $this->article->create($request->except('_token'));
        event(new NewArticle($article));
        return redirect()->route('article.index', $article);
    }
    # Удаление статьи по id
    public function delete($id)
    {
        // Фильтр поиска статьи по id
        $article = $this->article->find($id);
        // Если авторизованный пользователь и есть автор
        if (auth()->user()->id == $article->user_id) {
            $article->delete();
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
        $article = $this->article->find($id);
        $categories =  $this->category->all($id);
        // Если авторизованный пользователь и есть автор
        if (auth()->user()->id == $article->user_id) {
            // Выводим форму для редактирования
            return view('article.edit', compact('article','categories'));
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
        $article = $this->article->find($id);
        // Забираем значения с Input form'ы
        $article->update([
            'title' => $request->title,
            'text' => $request->text,
            'category_id' => $request->category_id,
            ]);
        // Записываем изменения
        $article->save();
        // Редирект на текущюю статью
        return redirect()->route('article.show', $article);
    }

    public function category($category_id) {
        $articles = $this->article->all()->where('category_id', $category_id);
        // $article = Article::where('category_id', $category_id -> id);

        $categories = $this->category->all();

        return view('article.category', compact('articles','categories'));
    }
    public function search() {
        $query = Input::get('search');
        $categories = $this->category->all();
        $articles = $this->article->where("title", "LIKE","%$query%")->get();
        return view('article.search',compact('articles','categories'));
    }

    # Изменение рейтинга статьи: +
    public function upRate($id)
    {
        // Фильтр поиска статьи по id
        $article = $this->article->find($id);
        # Увеличение рейтинга статьи на единицу
        $article->rating++;
        $article->save();
        // Создание статуса голоса пользователя для текущей статьи
        $user = $this->user->auth();
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
    public function downRate($id)
    {
        // Фильтр поиска статьи по id
        $article = $this->article->find($id);
        # Уменьшение рейтинга статьи на единицу
        $article->rating--;
        $article->save();
        // Создание статуса голоса пользователя для текущей статьи
        $user = $this->user->auth();
        $vote = $user->votes()->firstOrCreate([
            'article_id' => $id
        ]);
        // Если проголосовал против: false
        $vote->vote = false;
        $vote->save();
        // Редирект на текущюю статью
        return redirect()->route('article', ['id' => $article->id]);
    }
    public function resetRate($id)
    {
        $article = $this->article->find($id);
        # Уменьшение рейтинга статьи на единицу
        // Создание статуса голоса пользователя для текущей статьи
        $user = $this->user->auth();
        $vote = $user->votes()->where('article_id', $id)->first();
        $article->rating += $vote->vote ? -1 : 1;
        $article->save();
        $vote->delete();
        // Редирект на текущюю статью
        return redirect()->route('article', ['id' => $article->id]);
    }


}