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

    public function category($category_id) {
        $articles = Article::all()->where('category_id', $category_id);
        // $articles = Article::where('category_id', $category_id -> id);
        return view('category', compact('articles'));
    }

    public function search() {
        $query = Input::get('search');

        $articles = Article::where("title", "LIKE","%$query%")->get();

        return view('search',compact('articles'));
    }

    public function admin() {
        $user_id = \Auth::user()->id;

        if($user_id == 1) {
            return view('admin');
        }

        else {
            return "У вас нет прав на просмотр этой страницы";
        }
    }
}
