<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Input;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

}
