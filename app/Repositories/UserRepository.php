<?php
namespace App\Repositories;
use App\Interfaces\IUserRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
class UserRepository implements IUserRepository
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function all()
    {
        return $this->user->all();
    }
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function find($id)
    {
        return $this->user->find($id);
    }
    public function auth()
    {
        return Auth::user();
    }
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->user, $name], $arguments);
    }
}