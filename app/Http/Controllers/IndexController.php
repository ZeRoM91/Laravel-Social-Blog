<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
class IndexController extends Controller
{
    //
    public function index()
    {




        return view('index', compact('articles','authors','category'));

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

}
