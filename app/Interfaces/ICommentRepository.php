<?php
namespace App\Interfaces;

interface ICommentRepository
{
    public function all();
    public function find($id);
}