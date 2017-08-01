<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Status;
class LkUserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    # Вывод личного кабинета
    public function index()
    {
        $auth = auth('web')->user();
        // Добавляем список всех его статей с пагинацией
        $articles = $auth->articles()->paginate(5);

        $blogs = $auth -> blog() -> orderBy('created_at','desc') ->get();

        return view('lk.index', compact('articles','blogs','auth'));
    }

    # Редактирвоание информации
    public function edit()
    {

        return view('lk.edit');
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

    public function blog(Request $request)
    {

        $user = auth('web')->user();


        $blog = Blog::create([
            'user_id' => $user->id,
            'text' => \Request::get('blog')
        ]);

        return redirect()->back();

    }

}