<?php

namespace App\Services\Admin;

use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostService
{
    private $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    function getAll()
    {
        $posts =  PostResource::collection($this->post->oldest('id')->with('category', 'user')->get());
        if (request()->status == 'disabled') {
            $posts = $this->getPostsOnlyTrash();
        }
        return $posts;
    }

    function getPostsOnlyTrash()
    {
        $posts = PostResource::collection($this->post->onlyTrashed()
            ->oldest('title')->get());
        return $posts;
    }

    function find($id)
    {
        $post = $this->post->find($id);

        if (!$post) {
            throw new ModelNotFoundException('not found by ID ');
        }
        $userLogin = auth()->user();
        $userRoles = $userLogin->roles->pluck('name')->toArray();
        // check admin
        $isAdmin = in_array('admin', $userRoles);
        // role post
        $postAuthorRoles = $post->user->roles->pluck('name')->toArray();
        if (!($isAdmin || !empty(array_intersect($userRoles, $postAuthorRoles)))) {
            throw new ModelNotFoundException('User does not have permission to access this post');
        }
        return $post;
    }

    function upLoadImg($image, $slug)
    {
        $fileName = $slug . '-' . time() . '.' . strtolower($image->getClientOriginalExtension());
        $path = $image->storeAs('public/posts', $fileName);
        return "storage/posts/" . $fileName;
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

    // update

    function handleUpdateImg($id, $newImage, $slug)
    {
        if (!empty($newImage)) {
            $img_old = $this->find($id)->image;
            Storage::delete($img_old);
        }
        $fileName = $slug . '-' . time() . '.' . strtolower($newImage->getClientOriginalExtension());
        $path = $newImage->storeAs('public/posts', $fileName);
        return "storage/posts/" . $fileName;
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

    function findOnlyTrash($id)
    {
        $post = $this->post->onlyTrashed()->find($id);
        if (!$post) {
            throw new ModelNotFoundException('not found ID ');
        }
        return $post;
    }

    function restore($id)
    {
        $post = $this->findOnlyTrash($id);
        $category = $post->category;
        if ($category->deleted_at !== null) {
            throw new ModelNotFoundException('Category not found ');
        }
        return $post->restore();
    }

    function forceDelete($id)
    {
        $post = $this->findOnlyTrash($id);
        Storage::delete($post->image);
        return $post->forceDelete();
    }
}
