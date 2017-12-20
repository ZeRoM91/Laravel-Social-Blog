<?php
namespace App\Repositories;
use App\Interfaces\IArticleRepository;
use App\Models\Article;

class ArticleRepository implements IArticleRepository
{
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
    public function all()
    {
        return $this->article->all();
    }
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function find($id)
    {
        return $this->article->find($id);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->article, $name], $arguments);
    }
}