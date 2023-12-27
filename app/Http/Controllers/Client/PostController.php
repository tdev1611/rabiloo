<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    protected $post;
    protected $category;
    protected $tag;
    function __construct(Post $post, Category $category, Tag $tag)
    {
        $this->post = $post;
        $this->category = $category;
        $this->tag = $tag;
    }


    function getPostsByCategory($slug)
    {
        try {
            $category = $this->category->where('slug', $slug)->first();
            $this->ModelNotFoundException($category);
            $posts = $this->post->where('category_id', $category->id)->where('is_published', 2)->withCount('likes')->with('tags', 'user')->latest()->paginate(8);
            // $posts = PostResource::collection($qry);
            return view('client.posts.byCategory', compact('posts', 'category'));
        } catch (ModelNotFoundException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    function getPostsByTag($slug)
    {
        try {
            $tag = $this->tag->where('slug', $slug)->first();
            $this->ModelNotFoundException($tag);
            // get posts

            $posts = $tag->posts()->where('is_published', 2)->withCount('likes')->with('tags', 'user')->latest()->paginate(8);

            return view('client.posts.byTag', compact('tag', 'posts'));
        } catch (ModelNotFoundException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    function show($slug)
    {

        try {
            $post = $this->post->where('slug', $slug)->where('is_published', 2)->with('comments.user', 'tags')->first();
            if (!$post) {
                throw new ModelNotFoundException('Post not found ');
            }

            return view('client.posts.show', compact('post'));
        } catch (ModelNotFoundException $e) {
            return back()->withError($e->getMessage());
        }
    }

    function ModelNotFoundException($data)
    {
        if (!$data) {
            throw new ModelNotFoundException('not found ');
        }
        return $data;
    }
}
