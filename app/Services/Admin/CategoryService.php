<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class CategoryService
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    function getAll()
    {
        $categories = CategoryResource::collection($this->category->oldest('title')->get());

        if (request()->status == 'disabled') {
            $categories = $this->getCategoryOnlyTrash();
        }
        return $categories;
    }

    function getCategoryOnlyTrash()
    {
        $categories = CategoryResource::collection($this->category->onlyTrashed()
            ->oldest('title')->get());
        return $categories;

    }

    // get status ==1
    function getcategoryActive()
    {
        return $this->category->where('status', 1)->latest()->get();
    }

    function find($id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            throw new ModelNotFoundException('not found  ID ');
            }
        return $category;
    }

    function store($data)
    {
        return $this->category->create($data);
    }

    public function categoryById($id)
    {
        $category = $this->find($id);
        return new CategoryResource($category);
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


    function findOnlyTrash($id)
    {
        $category = $this->category->onlyTrashed()->find($id);
        if (!$category) {
            throw new ModelNotFoundException('not found ID '  );
        }
        return $category;
    }

    function restore($id)
    {
        $category = $this->findOnlyTrash($id);
        return $category->restore();
    }

    function forceDelete($id)
    {
        $category = $this->findOnlyTrash($id);
        return $category->forceDelete();
    }

}
