<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
            ->where('published_at', '<=', now())
            ->where('is_published', 1)
            ->get();
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }
}
