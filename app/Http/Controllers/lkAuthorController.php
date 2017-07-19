<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Friend;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\User;

class LkAuthorController extends Controller
{
    # Вывод личного кабинета
    public function show()
    {
        // Поиск пользователя по id
        $user = auth('web')->user();
        // Добавляем список всех его статей с пагинацией
        $articles = $user->articles()->paginate(2);

        $friends = $user->friends;


        $outcomings = $user ->outcomingRequests;

        $incomings = $user ->incomingRequests;





        return view('lk', compact('articles', 'friends','outcomings','incomings'));
    }

    public function user()
    {

        $users = User::all();
        return view('user', compact('users'));
    }

    public function profile($id)
    {

        $user = User::find($id);



        $auth = auth('web')->user();




        $friends = $auth->friends;


        $outcomings = $auth ->outcomingRequests;

        $incomings = $auth ->incomingRequests;




dd($messages);
        return view('profile', compact('user', 'auth', 'friends','outcomings','incomings','messages'));


    }


    public function friend__send(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);

        auth('web')->user()->sendFriend()->attach($id, ['status' => false]);

        return redirect()->route('Author');
    }

    public function friend_accept(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);

        auth('web')->user()->sendFriend()->attach($id, ['status' => true]);


        \DB::table('friends')->where('from_user_id', $id)->update(['status' => true]);





        return redirect()->route('Author');
    }


    public function friend_decline(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);

        auth('web')->user()->sendFriend()->detach($id);


        \DB::table('friends')->where('from_user_id', $id)->delete();


        return redirect()->route('Author');
    }

    public function message__send(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);

        auth('web')->user()-> sendMessage()->where('to_user_id', $id)->attach($id, ['message' => Input::get('message3')]);



        return redirect()->route('Author');
    }
}
