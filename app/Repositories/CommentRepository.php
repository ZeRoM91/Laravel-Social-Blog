<?php
namespace App\Repositories;
use App\Interfaces\ICommentRepository;
use App\Models\Comment;

class CommentRepository implements ICommentRepository
{
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    public function all()
    {
        return $this->comment->all();
    }
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function find($id)
    {
        return $this->comment->find($id);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->comment, $name], $arguments);
    }
}