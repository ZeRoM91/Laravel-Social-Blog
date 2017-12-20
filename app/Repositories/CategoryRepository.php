<?php
namespace App\Repositories;
use App\Interfaces\ICategoryRepository;
use App\Models\Category;

class CategoryRepository implements ICategoryRepository
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function all()
    {
        return $this->category->all();
    }
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function find($id)
    {
        return $this->category->find($id);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->category, $name], $arguments);
    }
}