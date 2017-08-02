<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Input;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Выводим список статей
        $articles = Article::paginate(5);
        $categories = Category::all();

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
