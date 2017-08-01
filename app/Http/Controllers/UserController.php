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
        return redirect()->route('lk');
    }

    public function friend_decline(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);
        auth('web')->user()->sendFriend()->detach($id);
        \DB::table('friends')->where('from_user_id', $id)->delete();
        return redirect()->route('lk');
    }

    public function messages__user($id)
    {



        $user = User::find($id);
        $auth = auth('web')->user();
        //  $messages_unread = $auth->messages->where('status', false);
        $friend = $auth->friends->where('to_user_id', $id);
        $friends = $auth->friends;
        // $messages = $auth ->incomingMessages;

        if ($friend) {


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
        else {
            return "У вас нет прав";
    }
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

