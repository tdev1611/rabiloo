<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    protected $post;
    protected $category;
    function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    function getPostsByCategory($slug)
    {
        try {
            $category = $this->category->where('slug', $slug)->first();
            $this->ModelNotFoundException($category);

            $posts = $this->post->where('category_id', $category->id)->where('is_published', 2)->with('comments.user')->paginate(12);

            return view('client.posts.byCategory', compact('posts','category'));
        } catch (ModelNotFoundException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    function show($slug)
    {
        try {
            $post = Post::where('slug', $slug)->where('is_published', 2)->with('comments.user')->first();

            $this->ModelNotFoundException($post);
            return view('client.posts.show', compact('post'));
        } catch (ModelNotFoundException $e) {
            return back()->withError($e->getMessage());
        }
    }

    function ModelNotFoundException($data)
    {
        if (!$data) {
            throw new ModelNotFoundException($data . 'not found ');
        }
        return $data;
    }
}
