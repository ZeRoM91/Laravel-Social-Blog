<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Photo;
use App\Models\Audio;
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
        $avatar->move('storage/avatars',$imageName);
        $user -> avatar = $imageName;
        $user->save();
        return redirect('lk');
    }


    public function sendPhoto(Request $request)

    {
        $user = auth('web')->user();
        $photo =  $request->file('photo');

        $imageName = $user->id.'.'. rand() . '.'. $request->file('photo')->getClientOriginalExtension();



        $photo->move('storage/' . $user->id . '/photos', $imageName);



        $user = Photo::create([
            'user_id' => $user -> id,
            'link' => $imageName,
        ]);

        $user ->save();

        return redirect('photos');
    }

    public function sendAudio(Request $request)

    {
        $user = auth('web')->user();
        $photo =  $request->file('audio');

        $audio = $user->id.'.'. rand() . '.'. $request->file('audio')->getClientOriginalExtension();

        $name = $request->file('audio')->getClientOriginalName();

        $photo->move('storage/' . $user->id . '/audios', $audio);



        $user = Audio::create([
            'user_id' => $user -> id,
            'link' => $audio,
            'name' => $name,
        ]);

        $user ->save();

        return redirect()->back();
    }
}
