<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use EloquentFilter\Filterable;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    protected $guarded = [];


    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\PostFilter::class);
    }

    function getScheduledPosts()
    {
        return $this->whereNotNull('published_at')
            ->where('published_at', '>=', now())
            ->where('is_published', 1)
            ->get();
    }

    //relation
    function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }
    function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    function forceDeleted($id)
    {
        $post = $this->onlyTrashed()->find($id);
        Storage::delete($post->image);
        return $post->forceDelete();
    }

    // comments
    function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
    // likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    // likesCount
    public function likesCount()
    {
        return $this->likes()->count();
    }
}
