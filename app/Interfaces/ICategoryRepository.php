<?php
namespace App\Interfaces;

interface ICategoryRepository
{
    public function all();
    public function find($id);
}