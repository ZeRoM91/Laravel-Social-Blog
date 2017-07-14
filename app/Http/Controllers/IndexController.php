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
}
