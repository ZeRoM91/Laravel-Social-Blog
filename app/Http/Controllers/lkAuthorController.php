<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class LkAuthorController extends Controller
{
    # Вывод личного кабинета
    public function show()
    {
        // Поиск пользователя по id
       $user_id = \Auth::user()->id;
       // Добавляем список всех его статей с пагинацией
       $articles = Article::where('user_id', $user_id)->paginate(10);
        return view('lk', compact('articles'));
    }
}
