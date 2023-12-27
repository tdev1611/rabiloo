<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
class HomeController extends Controller
{
    protected $post;
    function __construct(Post $post)
    {
        $this->post = $post;
    }

    function index()
    {
        $qry = $this->post->where('is_published', 2)->withCount('likes')->with('tags', 'user')->latest()->paginate(8);
        $posts = PostResource::collection($qry);

        return view('welcome', compact('posts'));
    }

    function search(Request $request)
    {

        $posts= Post::filter($request->all())->paginate(8);
        return view('client.search.index', compact('posts'));
    }
}
