<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Support\Facades\Input;
use App\Events\ChatMessage;


class ChatController extends Controller
{
    //
    public function getIndex() {

        $messages = Chat::all();
        return view('chat',compact('messages'));
    }

    public function postMessage(Request $request) {

        $message =  Chat::create($request->all());

            event(
                new ChatMessage($message)
            );
      return redirect()->back();
    }
}
