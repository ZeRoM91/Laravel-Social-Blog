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

       $categories = Category::all();

        $articles = Article::paginate(5);      //  dd($article);



        return view('home', compact('articles','categories'));
    }

    public function category($category_id) {
        $articles = Article::all()->where('category_id', $category_id);
        // $articles = Article::where('category_id', $category_id -> id);
        $categories = Category::all();
        return view('category', compact('articles','categories'));
    }

    public function search() {
        $query = Input::get('search');

        $categories = Category::all();

        $articles = Article::where("title", "LIKE","%$query%")->get();



        return view('search',compact('articles','categories'));
    }


}
