<?php

namespace App\Traits;
use App\Interfaces\IArticleRepository;
use App\Interfaces\ICategoryRepository;
use App\Interfaces\ICommentRepository;
use App\Interfaces\IUserRepository;

trait ArticleConstructorTrait
{

    public function __construct(
        IUserRepository $user,
        IArticleRepository $article,
        ICommentRepository $comment,
        ICategoryRepository $category
    )
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->article = $article;
        $this->comment = $comment;
        $this->category = $category;
    }
}