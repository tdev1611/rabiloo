<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$id): Response
    {
        $post = Post::where('id',$id)->where('user_id', auth()->user()->id)->first();
        if (!$post) {
            throw new ModelNotFoundException('Post not found ');
        }
        return $next($request);
    }
}
