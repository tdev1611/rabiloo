<?php

namespace App\Services\Admin;

use App\Models\Post;
use App\Http\Resources\PostResource;

class PostService
{
    private $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    function getAll()
    {
        return  PostResource::collection($this->post->oldest('title')->with('category')->get());
    }
 


    function find($id)
    {
        $post = $this->post->find($id);
        if ($post === null) {
            abort(404);
        }
        return  $post;
    }

    function upLoadImg($image, $slug)
    {
        $fileName = $slug . '-' . time() . '.' . strtolower($image->getClientOriginalExtension());
        $path = $image->storeAs('public/posts', $fileName);
        return "public/posts/" . $fileName;
    }

    function store($data)
    {
        return $this->post->create($data);
    }

    public function postById($id)
    {
        $post = $this->find($id);
        return new PostResource($post);
    }


    function update($id, $data)
    {
        $post = $this->find($id);
        $post->update($data);
        return $post;
    }

    function delete($id)
    {
        $post = $this->find($id);
        return $post->delete();
    }
}
