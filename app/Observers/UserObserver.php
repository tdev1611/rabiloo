<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Post;
 
class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $post_ids = $user->posts->pluck('id')->toArray();
        $deleted = Post::whereIn('id', $post_ids)->delete();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        $user->posts()->restore();
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        $posts = $user->posts;
        foreach ($posts as $post) {
            $post->forceDeleted();
        }
    }
}
