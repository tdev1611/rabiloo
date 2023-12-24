<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    // protected $attributes = [
    //     'user_id' => auth()->user() ? auth()->user()->id :   1,
    // ];

    function post()
    {
        return $this->belongsTo(Post::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
