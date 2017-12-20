<?php
namespace App\Interfaces;

interface IArticleRepository
{
    public function all();
    public function find($id);
}