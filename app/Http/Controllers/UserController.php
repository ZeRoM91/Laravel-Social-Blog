<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Message;
use App\Models\Status;
use App\Models\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\User;
use App\Events\ChatMessage;
use App\Events\NewMessage;
use App\Events\NewFriend;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # Вывод личного кабинета
    public function personal()
    {
        // Поиск пользователя по id
        $user = auth('web')->user();
        // Добавляем список всех его статей с пагинацией
        $articles = $user->articles()->paginate(2);
        $friends = $user->friends;
        $outcomings = $user->outcomingRequests;
        $incomings = $user->incomingRequests;


        return view('lk', compact('articles', 'friends', 'outcomings', 'incomings'));
    }

    public function status(Request $request)
    {

        $user = auth('web')->user();

        if (!isset($user->status)) {
            $status = Status::create([
                'user_id' => $user->id,
                'status' => \Request::get('status')
            ]);
        }

        return redirect()->back();
    }

    public function editStatus(Request $request)
    {
        $user = auth('web')->user();
        $status = $user->status;
        $status->status = \Request::get('status');
        $status->save();

        return redirect()->back();


    }

    public function user($id)
    {

        $user = User::find($id);

        $auth = auth('web')->user();

        $status = $user->status;

        $isFriend = $auth->sendFriend()->where('to_user_id', $id)->get()->first();


        return view('user', compact('user', 'isFriend', 'status'));
    }

    public function friend__send(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);
        auth('web')->user()->sendFriend()->attach($id, ['status' => false]);
        event(new NewFriend());
        return redirect()->back();

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

    public function messages__user($id)
    {
        $user = User::find($id);
        $auth = auth('web')->user();
        //  $messages_unread = $auth->messages->where('status', false);
        $friend = $auth->friends->where('to_user_id', $id);
        $friends = $auth->friends;
        // $messages = $auth ->incomingMessages;
        $messages = Message::where([
            'to_user_id' => $auth->id,
            'from_user_id' => $id
        ])->orWhere([
            'to_user_id' => $id,
            'from_user_id' => $auth->id
        ]);


        $messages = $messages->get();

        Message::where('to_user_id', $auth->id)->update(['status' => true]);


        return view('left-bar.messages__user', compact('user', 'friend', 'friends', 'messages'));
    }

    public function message__send(Request $request, $id)
    {


        $auth = auth('web')->user();
        $user = User::find($id);


        $message = Message::create([
            'from_user_id' => $auth->id,
            'to_user_id' => $user->id,
            'message' => $request->message,
            'status' => false
        ]);
        event(new ChatMessage($message));
        event(new NewMessage());
        return redirect()->back();


    }

}

