<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    protected $post;
    function __construct(Post $post)
    {
        $this->post = $post;
    }

  

    function show($slug)
    {

        try {
            $post = Post::where('slug', $slug)->where('is_published', 2)->with('comments.user')->first();
            if (!$post) {
                throw new ModelNotFoundException('Post not found ');
            }

            return view('client.posts.show', compact('post'));
        } catch (ModelNotFoundException $e) {
            return back()->withError($e->getMessage());
        }
    }
}
