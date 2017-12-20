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

    public function user($id)
    {
        $user = $this->user->find($id);
        $auth = $this->user->auth();
        $status = $user->status;
        $friend = $auth->friends()->where('to_user_id', $id)->first();
        $isFriend = $auth->sendFriend()->where('to_user_id', $id)->first();
        $inFriend = $auth->incomingRequests()->where('from_user_id', $id)->first();
        $outFriend = $auth->outcomingRequests()->where('to_user_id', $id)->first();
        return view('user', compact('user', 'isFriend', 'inFriend', 'outFriend', 'status', 'friend'));
    }
    public function friend__send(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);
        $this->user->auth()->sendFriend()->attach($id, ['status' => false]);
        event(new NewFriend());
        return redirect()->back();
    }
    public function friend_accept(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:users'
        ]);
        $this->user->auth()->sendFriend()->attach($id, ['status' => true]);
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
        return view('left-bar.messages__user', compact('user', 'friend', 'friends', 'messages'));
    }
    public function message__send(Request $request, $id)
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
}
