<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\User;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    /*
     * Вывод приложения с пагинацией
     *
     */
    public function index()
    {

       // $article = Article::all()->select('user_id');

        //$authors = $article->author;
        $articles = Article::paginate(10);




      //  dd($article);
        return view('home', compact('articles','authors'));
    }

    public function category($category) {

        $articles = Article::all()->where('category',$category);

        return view('category', compact('articles'));

    }
}
