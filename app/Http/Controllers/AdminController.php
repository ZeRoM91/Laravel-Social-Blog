<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class AdminController extends Controller
{
    //

    public function index() {
        $user_id = \Auth::user()->id;
        if($user_id == 1) {


            return view('admin.index');
        }
        else {
            return "У вас нет прав на просмотр этой страницы";
        }
    }

    public function category() {
        $user_id = \Auth::user()->id;
        if($user_id == 1) {

            $categories = Category::all();
            return view('admin.category',compact('categories'));
        }
        else {
            return "У вас нет прав на просмотр этой страницы";
        }
    }

    public function categoryPost(Request $request) {
        $user_id = \Auth::user()->id;
        if($user_id == 1) {

            $categories = Category::updateOrCreate([

                'name' => $request->category
            ]);

            return redirect()->back();
        }
        else {
            return "У вас нет прав на просмотр этой страницы";
        }
    }
    public function categoryUpdate(Request $request) {
        $user_id = \Auth::user()->id;
        if($user_id == 1) {

            if (\Request::get('category')) {
                // Do anything here
                $checked = \Request::get('category');

                // dd($checked);



                Category::update([
                    'id' => $checked,
                    'name' => $request->name
                ]);

            }




            return redirect()->back();
        }
        else {
            return "У вас нет прав на просмотр этой страницы";
        }
    }

    public function categoryDelete(Request $request) {
        $user_id = \Auth::user()->id;
        if($user_id == 1) {

            if (\Request::get('category')) {
                // Do anything here
                $checked = \Request::get('category');

               // dd($checked);


                Category::destroy([
                    'id' => $checked
                ]);

            }




            return redirect()->back();
        }
        else {
            return "У вас нет прав на просмотр этой страницы";
        }
    }
}
