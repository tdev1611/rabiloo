<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
class PostFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];
  
  

    public function title($key)
    {
        return $this->where('title', 'like', '%' . $key . '%')->where('is_published', 2);
    }

    public function author($key)
    {
        return $this->WhereHas('user', function (Builder $query) use ($key) {
            $query->where('name', 'like', '%' . $key . '%');
        })->where('is_published', 2);
    }

}
