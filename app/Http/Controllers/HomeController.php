<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\User;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


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
        $articles = Article::paginate(10);      //  dd($article);



        return view('home', compact('articles','authors','category'));
    }

    public function category(Category $category) {
        $articles = Article::where('category_id', $category->id)->get();

        return view('category', compact('articles','category'));
    }

    public function search() {
        $query = Input::get('search');

        $articles = Article::where("title", "LIKE","%$query%")->get();

        return view('search',compact('articles'));
    }
}
