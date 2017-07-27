<?php namespace App\Events;

use App\Events\Event;
use App\User;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NewFriend extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;

    public function __construct()
    {
        $this->data = array(
            'firstname'=> \Auth::user()-> firstname,
            'lastname'=> \Auth::user()-> lastname,
        );
    }

    public function broadcastOn()
    {
        return ['new-friend'];
    }
}