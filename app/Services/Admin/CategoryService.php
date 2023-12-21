<?php

namespace App\Services\Admin;

use App\Models\Category;


class CategoryService
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    function getAll()
    {
        return $this->category->oldest('title')->get();
    }

    // get status ==1
    function getcategoryActive()
    {
        return $this->category->where('status', 1)->latest()->get();
    }

    function find($id)
    {
        $category = $this->category->find($id);
        if ($category === null) {
            abort(404);
        }
        return $category;
    }

    function store($data)
    {
        return $this->category->create($data);
    }

    function update($id, $data)
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;
    }

    function delete($id)
    {
        $category = $this->find($id);
        return $category->delete();
    }
}
