<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class FileController extends Controller
{
    //

    public function avatar(Request $request)

    {
        $user = auth('web')->user();
        $avatar =  $request->file('avatar');

        $imageName = $user->id.'.'.$request->file('avatar')->getClientOriginalExtension();

        $avatar->move('avatars',$imageName);

        $user -> avatar = $imageName;
        $user->save();
        return redirect('lk');
    }
}
