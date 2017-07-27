<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Message;

use Illuminate\Support\Facades\Input;
class IndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        return view('index', compact('articles','authors','category'));
    }
    public function searchUsers() {
        $query = Input::get('searchUser');
        $users = User::where("name", "LIKE","%$query%")->get();
        return view('searchUsers', compact('users'));
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
        $incomings = $auth ->incomingRequests;
        $friends = $auth->friends;
        return view('left-bar.friends',compact('friends','incomings'));
    }
    public function news() {
        return view('header.news');
    }
    public function messages() {

        $friends = auth('web')->user()->friends()->hasMessages()->get();

        return view('left-bar.messages', compact('friends'));

    }


}
