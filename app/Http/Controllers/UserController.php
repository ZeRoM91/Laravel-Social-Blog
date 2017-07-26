<?php

namespace App\Http\Controllers;


use App\Models\Message;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\User;
use App\Events\ChatMessage;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # Вывод личного кабинета
    public function personal() {
        // Поиск пользователя по id
        $user = auth('web')->user();
        // Добавляем список всех его статей с пагинацией
        $articles = $user->articles()->paginate(2);
        $friends = $user->friends;
        $outcomings = $user ->outcomingRequests;
        $incomings = $user ->incomingRequests;
         return view('lk', compact('articles', 'friends','outcomings','incomings'));
    }
    public function user($id) {

        $user = User::find($id);

        $auth = auth('web')->user();

        $friend = $auth ->sendFriend()->where('to_user_id',$id);

        return view('user', compact( 'user','friend'));
    }
    public function friend__send(Request $request, $id) {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);
        auth('web')->user()->sendFriend()->attach($id, ['status' => false]);
        return redirect()->route('Author');
    }
    public function friend_accept(Request $request, $id) {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);
        auth('web')->user()->sendFriend()->attach($id, ['status' => true]);
        \DB::table('friends')->where('from_user_id', $id)->update(['status' => true]);
        return redirect()->route('Author');
    }
    public function friend_decline(Request $request, $id) {
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


        $message = Message::create([
            'from_user_id' => $auth -> id,
            'to_user_id'    => $user -> id,
           'message'    => $request->message,
            'status' => false
        ]);

      //event(new ChatMessage($message)); // Also tried this
        return redirect()->back();
    }


}
