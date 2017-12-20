<?php
namespace App\Interfaces;

interface IUserRepository
{
    public function all();
    public function find($id);
    public function auth();
}