<?php

namespace App\Traits;


use App\Interfaces\IMessageRepository;
use App\Interfaces\IUserRepository;



trait UserConstructorTrait
{

    public function __construct(
        IUserRepository $user,
        IMessageRepository $message
    )
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->message = $message;
    }

}