<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ArticleController;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CommentController extends Controller
{
    //



    public function add($id) {

        $article = Article::find($id);

        $comment = Comment::create(['article' => Input::get('article'), 'comment' => Input::get('comment'),'author' => Input::get('author')]);

        return redirect()->route('article', ['id' => $article->id]);

    }
}
