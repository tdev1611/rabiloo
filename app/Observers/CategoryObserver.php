<?php

namespace App\Observers;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use App\Models\Category;
use App\Models\Post;
class CategoryObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
     
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $post_ids = $category->posts->pluck('id')->toArray();

        $deleted = Post::whereIn('id', $post_ids)->delete();
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        $category->posts()->restore();
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        $posts = $category->posts;
        foreach ($posts as $post) {
            $post->forceDeleted();
        }
    }
}
