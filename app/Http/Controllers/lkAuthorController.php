<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\User;
class LkAuthorController extends Controller
{
    # Вывод личного кабинета
    public function show()
    {
        // Поиск пользователя по id
       $user_id = \Auth::user()->id;
       // Добавляем список всех его статей с пагинацией
       $articles = Article::where('user_id', $user_id)->paginate(2);
        return view('lk', compact('articles'));
    }

    public function user() {

        $users = User::all();
        return view('user', compact('users'));
    }

    public function profile($id) {

        $user = User::find($id);


        // Добавляем список всех его статей с пагинацией







        return view('profile', compact('user'));
    }
}
