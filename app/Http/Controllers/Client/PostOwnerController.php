<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostOwnerController extends Controller
{
    protected $post;
    function __construct(Post $post)
    {
        $this->post = $post;
    }

    function index()
    {
        $qry = $this->post->where('user_id', auth()->user()->id)->withCount('likes')->latest()->get();
        $posts =  PostResource::collection($qry);
        if (request()->status == 'disabled') {
            $posts = $this->getPostsOnlyTrash();
        }

        return view('client.posts-owner.index', compact('posts'));
    }

    function getPostsOnlyTrash()
    {
        $posts = PostResource::collection($this->post->onlyTrashed()
            ->oldest('title')->get());
        return $posts;
    }

    function show($slug)
    {

        try {
            $post = Post::where('slug', $slug)->where('user_id', auth()->user()->id)->with('comments.user')->first();
            if (!$post) {
                throw new ModelNotFoundException('Post not found ');
            }

            return view('client.posts-owner.show', compact('post'));
        } catch (ModelNotFoundException $e) {
            return back()->withError($e->getMessage());
        }
    }
}
