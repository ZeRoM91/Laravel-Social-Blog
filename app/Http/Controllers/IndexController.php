<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\User;
use App\Models\Message;

class IndexController extends Controller
{
    //
    public function index()
    {


        $auth = auth('web')->user();
        $messages__unread = $auth->messagesTo->where('status', false);


        return view('index', compact('articles','authors','category','messages__unread'));

    }

    public function admin() {
        $user_id = \Auth::user()->id;

        if($user_id == 1) {
            return view('admin.index');
        }

        else {
            return "У вас нет прав на просмотр этой страницы";
        }
    }

    public function faq() {


        return view('faq');
    }

    public function friends() {
        $auth = auth('web')->user();




        $friends = $auth->friends;

        return view('left-bar.friends',compact('friends'));
    }


    public function news() {
        return view('header.news');
    }


    public function messages() {

        $auth = auth('web')->user();
        $messages__unread = $auth->messagesTo->where('status', false);
        $update = Message::where('to_user_id',$auth -> id)->update(['status' => true]);
        $friends = $auth->friends;
        return view('left-bar.messages', compact('messages__unread','friends','outcomings','incomings','messages','messages_in'));

    }

    public function messages__user($id) {

        $user = User::find($id);
        $auth = auth('web')->user();
        //  $messages_unread = $auth->messages->where('status', false);

        $friends = $auth->friends;
        $outcomings = $auth ->outcomingRequests;
        $incomings = $auth ->incomingRequests;

        // $messages = $auth ->incomingMessages;
        $messages = $auth->messages->where('to_user_id',$id);
        $messages_in = $user->messages->where('to_user_id',$auth -> id);

        return view('left-bar.messages__user', compact('user', 'auth', 'friends','outcomings','incomings','messages','messages_in'));

    }

}
