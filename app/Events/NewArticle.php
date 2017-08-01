<?php namespace App\Events;

use App\Events\Event;
use App\User;
use App\Models\Article;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NewArticle extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;

    public function __construct(Article $article)
    {
        $this->data = array(
            'title'=> $article -> title,
        );
    }

    public function broadcastOn()
    {
        return ['new-article'];
    }
}