<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    function showMain() {
        return view('index');
    }

    function showName() {
        $name = "This";
        return view('index', compact('name'));
    }


    public function VkProvider()
    {


       // return Socialite::with('vkontakte')->redirect();

        return Socialite::with('vkontakte')->stateless(false)->redirect();
        $user = Socialite::driver('vkontakte')->user();
        $accessTokenResponseBody = $user->accessTokenResponseBody;


    }
}
