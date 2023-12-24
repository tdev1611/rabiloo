<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LikeController extends Controller
{
    protected $like;
    function __construct(Like $like)
    {
        $this->like = $like;
    }
    function store(Request $request, Post $post)
    {
        try {
            $post_id = $post->id;
            $user_id =  auth()->user() ? auth()->user()->id : 1;
            $likeExists = $this->findLike($post_id, $user_id)->exists();
            if ($likeExists) {
                $this->findLike($post_id, $user_id)->forceDelete();
                $response = [
                    'success' => true,
                    'message' => 'Unlike post success'
                ];
            } else {
                $this->like->create([
                    'user_id' => $user_id,
                    'post_id' => $post_id,
                ]);
                $response = [
                    'success' => true,
                    'message' => 'Like post success'
                ];
            }

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    function findLike($post_id, $user_id)
    {
        return  $this->like->where('post_id', $post_id)->where('user_id', $user_id);
    }
}
