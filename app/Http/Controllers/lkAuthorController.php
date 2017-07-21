<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Friend;
use App\Models\Message;
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

    public function users()
    {

        $users = User::all();
        return view('users', compact('users'));
    }

    public function user($id)
    {

        $user = User::find($id);



        $auth = auth('web')->user();
      //  $messages_unread = $auth->messages->where('status', false);



        $friends = $auth->friends;


        $outcomings = $auth ->outcomingRequests;

        $incomings = $auth ->incomingRequests;


       // $messages = $auth ->incomingMessages;

        $messages = $auth->messages->where('to_user_id',$id);

        $messages_in = $user->messages->where('to_user_id',$auth -> id);



        return view('user', compact('user', 'auth', 'friends','outcomings','incomings','messages','messages_in'));


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
        $auth = auth('web')->user();

        $user = User::find($id);


        // Создание комментария для статьи
        $message = Message::create([
            'from_user_id' => $auth -> id,
            'to_user_id'    => $user -> id,
            'message'    => Input::get('message3'),
            'status' => false
        ]);



       // auth('web')->user()-> messages()->where('to_user_id', $id)->attach($id, ['message' => Input::get('message3')]);



        return redirect()->route('user__profile', ['id' => $user->id]);
    }
}
