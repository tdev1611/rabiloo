<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Client\StoreCommentRequest;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    protected $comment;
    function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    // StoreCommentRequest
    function store(StoreCommentRequest $request, Post $post)
    {
   
        $validate = $request->validated();

        try {
            $comment = $this->comment->create([
                'user_id' => auth()->user() ? auth()->user()->id : 1,
                'post_id' => $post->id,
                'content' => $validate['content'],
            ]);

            $response = [
                'success' => true,
                'message' => 'Comment Successfully'
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ]);
        }
    }
}
