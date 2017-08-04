<?php
//
//namespace App\Events;
//
//
//use App\Models\Message;
//use Illuminate\Broadcasting\Channel;
//use Illuminate\Queue\SerializesModels;
//use Illuminate\Broadcasting\Channel;
//use Illuminate\Broadcasting\PrivateChannel;
//use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Foundation\Events\Dispatchable;
//use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
//
//
//
//class ChatMessage extends Event implements ShouldBroadcast
//{
//    use Dispatchable, InteractsWithSockets, SerializesModels;
//
//    /**
//     * @var Message
//     */
//    public $data;
//
//    public function __construct(Message $message)
//    {
//
//        $this->data = array(
//            'content'=> $message -> message,
//        );
//    }
//
//    /**
//     * Get the channels the event should broadcast on.
//     *
//     * @return Channel|array
//     */
//    public function broadcastOn()
//    {
//     //return ['user.private.' . $this->data->userTo->id];
//        return ['userprivate'];
//    // return new Channel('user.private.' . $this->message->userTo->id);
//
//
//    }
//
//    public function broadcastAs()
//    {
//      //  return 'message';
//    }
//}



namespace App\Events;

use App\Events\Event;
use App\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\Channel;
use App\Models\Message;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ChatMessage extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;

    public function __construct(Message $message)
    {
        $this->data = array(
            'content'=> $message -> message,
        );
    }

    public function broadcastOn()
    {
       // return new PrivateChannel('user.private.' . $this->message->userTo->id);


        //return new Channel('user.private.');

        return ['user.private'];
    }
}