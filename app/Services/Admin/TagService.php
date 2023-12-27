<?php

namespace App\Services\Admin;

use App\Models\Tag;

use App\Http\Resources\TagResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TagService
{
    private $tag;
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    function getAll()
    {
        return  TagResource::collection($this->tag->oldest('title')->get());
    }



    function find($id)
    {
        $tag = $this->tag->find($id);
        if (!$tag) {
            throw new ModelNotFoundException('not found by ID ');
        }
        return $tag;
    }


    function store($data)
    {
        return $this->tag->create($data);
    }

    function getTagById($id)
    {
        return  new TagResource($this->find($id));
    }

    function update($id, $data)
    {
        $tag = $this->find($id);
        $tag->update($data);
        return $tag;
    }

    function delete($id)
    {
        $user = $this->find($id);
        $user->delete();
       
    }
}
