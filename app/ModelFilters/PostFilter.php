<?php

namespace App\ModelFilters;

use App\Models\Category;
use App\Models\User;
use EloquentFilter\ModelFilter;

class PostFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];
    protected $filterable = [  
        'title',
        'category',
        'user',
         
    ];
    function category()
    {
        return $this->belongsTo(Category::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function title($title)
    {
        return $this->where(function ($q) use ($title) {
            return $q->where('title', 'LIKE', "%$title%");
        });
    }
    // public function onlyShowDeletedForAdmins()
    // {
    //     if (auth()->user()->isAdmin()) {
    //         $this->withTrashed();
    //     }
    // }
    // public function setup()
    // {
    //     $this->onlyShowDeletedForAdmins();
    // }
}
