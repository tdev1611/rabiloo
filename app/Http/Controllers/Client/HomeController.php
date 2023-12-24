<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    protected $post;
    function __construct(Post $post)
    {
        $this->post = $post;
    }

    function index()
    {
        $posts = $this->post->where('is_published', 2)->withCount('likes')->latest()->get();
        return view('welcome', compact('posts'));
    }
}
