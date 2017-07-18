<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Friend;
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

        $auth = \Auth::user($id);




        return view('profile', compact('user','auth','friends'));



    }


    public function friend($id) {

        $user = User::find($id);

        $auth = \Auth::user();

        $friend = Friend::firstOrCreate([
            'from_user_id' => $auth->id,
            'to_user_id' => $id
        ]);
        $friend -> status = true;
        $friend->save();

        return redirect()->route('Author');
    }
}
