<?php
namespace App\Repositories;
use App\Interfaces\IMessageRepository;
use App\Models\Message;

class MessageRepository implements IMessageRepository
{
    public function __construct(Message $message)
    {
        $this->message = $message;
    }
    public function all()
    {
        return $this->message->all();
    }
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function find($id)
    {
        return $this->message->find($id);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->message, $name], $arguments);
    }
}