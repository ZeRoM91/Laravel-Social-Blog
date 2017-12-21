<?php
namespace App\Http\Controllers;

use App\Traits\UserConstructorTrait;
use Illuminate\Http\Request;
use App\Models\Photo;


class FileController extends Controller
{
    use UserConstructorTrait;

    public function avatar(Request $request)
    {
        $user = $this->user->auth();
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
}
