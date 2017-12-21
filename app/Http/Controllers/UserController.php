<?php

namespace App\Http\Controllers;

use App\Traits\UserConstructorTrait;
use Illuminate\Http\Request;
use App\Events\ChatMessage;
use App\Events\NewMessage;
use App\Events\NewFriend;
use App\Events\IndexHere;

class UserController extends Controller
{
    use UserConstructorTrait;


    # Вывод личного кабинета
    public function index()
    {
        $user = $this->user->auth();
        // Добавляем список всех его статей с пагинацией
        $articles = $user->articles()->paginate(5);
        $blogs = $user->blog()->orderBy('created_at', 'desc')->paginate(10);
        return view('user.index', compact('articles', 'blogs', 'user'));
    }


    public function show($id)
    {
        $user = $this->user->find($id);
        $auth = $this->user->auth();
        $status = $user->status;
        $friend = $auth->friends()->where('to_user_id', $id)->first();
        $isFriend = $auth->sendFriend()->where('to_user_id', $id)->first();
        $inFriend = $auth->incomingRequests()->where('from_user_id', $id)->first();
        $outFriend = $auth->outcomingRequests()->where('to_user_id', $id)->first();
        return view('user.show', compact('user', 'isFriend', 'inFriend', 'outFriend', 'status', 'friend'));
    }

    public function createFriend(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);
        $this->user->auth()->sendFriend()->attach($id, ['status' => false]);
        event(new NewFriend());
        return redirect()->back();
    }

    public function storeFriend(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);
        $this->user->auth()->sendFriend()->attach($id, ['status' => true]);
        \DB::table('friends')->where('from_user_id', $id)->update(['status' => true]);
        return redirect()->route('lk');
    }

    public function destroyFriend(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);
        auth('web')->user()->sendFriend()->detach($id);
        \DB::table('friends')->where('from_user_id', $id)->delete();
        return redirect()->route('lk');
    }

    public function showFriendMessages($id)
    {
        $user = $this->user->find($id);
        $auth = $this->user->auth();
        //  $messages_unread = $auth->messages->where('status', false);
        $friend = $auth->friends->where('to_user_id', $id);
        $friends = $auth->friends()->hasMessages()->get();
        // $messages = $auth ->incomingMessages;
        $messages = $this->message->where([
            'to_user_id' => $auth->id,
            'from_user_id' => $id
        ])->orWhere([
            'to_user_id' => $id,
            'from_user_id' => $auth->id
        ])->get();
        $this->message->where('to_user_id', $auth->id)->update(['status' => true]);
        event(new IndexHere());
        return view('user.message.friend', compact('user', 'friend', 'friends', 'messages'));
    }

    public function storeMessage(Request $request, $id)
    {
        $auth = $this->user->auth();
        $user = $this->user->find($id);
        $message = $this->message->create([
            'from_user_id' => $auth->id,
            'to_user_id' => $user->id,
            'message' => $request->message,
            'status' => false
        ]);
        event(new ChatMessage($message));
        event(new NewMessage());
        return redirect()->back();
    }

    # Редактирвоание информации
    public function edit()
    {
        return view('user.edit');
    }

    public function editPost(Request $request)
    {
        $user = $this->user->auth();
        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
        ]);
        $user->save();
        return redirect()->back();
    }

    public function storeStatus(Request $request)
    {
        $user = $this->user->auth();
        $user->status()->create([
            'user_id' => $user->id,
            'text' => $request->status,
        ]);
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        $user = $this->user->auth();
        $status = $user->status;
        $status->status = $request->status;
        $status->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $user = $this->user->auth();
        $status = $user->status;
        $status->delete();
        return redirect()->back();
    }

    public function storeBlog(Request $request)
    {
        $user = $this->user->auth();
        $user->blog()->create([
            'user_id' => $user->id,
            'text' => $request->blog,
        ]);

        return redirect()->back();
    }

    public function indexMessages()
    {
        $friends = $this->user->auth()->friends()->hasMessages()->get();
        return view('user.message.index', compact('friends'));
    }
}
