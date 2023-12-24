<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    // protected $attributes = [
    //     'user_id' => auth()->user()->id,
    // ];

    function getScheduledPosts()
    {
        return $this->whereNotNull('published_at')
            ->where('published_at', '>=', now())
            ->where('is_published', 1)
            ->get();
    }

    function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }
    function forceDeleted($id)
    {
        $post = $this->onlyTrashed()->find($id);
        Storage::delete($post->image);
        return $post->forceDelete();
    }
}
