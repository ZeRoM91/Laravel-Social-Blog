<?php
namespace App\Interfaces;

interface IMessageRepository
{
    public function all();
    public function find($id);
}