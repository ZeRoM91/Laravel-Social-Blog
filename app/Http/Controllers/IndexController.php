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

        $users = User::where("firstname", "LIKE","%$query%")->get();
        return view('searchUsers', compact('users'));
    }

    public function faq() {
        return view('faq');
    }
    public function friends() {
        $auth = auth('web')->user();
        $incomings = $auth ->incomingRequests;
        $outcomings = $auth->outcomingRequests;
        $friends = $auth->friends;

        return view('left-bar.friends',compact('friends', 'outcomings', 'incomings'));
    }
    public function news() {
        return view('header.news');
    }
    public function messages() {

        $friends = auth('web')->user()->friends()->hasMessages()->get();

        return view('left-bar.messages', compact('friends'));

    }

    public function photos() {


        $user = auth('web')->user();


        $photos = $user -> photos() ->paginate(12);


        return view('photo',compact('photos'));

    }
    public function audios() {



        $user = auth('web')->user();


        $audios = $user -> audios() ->paginate(15);


        return view('left-bar.audio',compact('audios'));

    }

    public function videos() {


        $user = auth('web')->user();


        $videos = $user -> videos() ->paginate(15);

        return view('left-bar.video',compact('videos'));

    }

    public function cash() {


        return view('left-bar.cash');

    }

    public function task() {


        return view('left-bar.task');

    }

}
