<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\Admin\TagService;
use App\Http\Resources\TagResource;
class TableTag extends Component
{
    /**
     * Create a new component instance.
     */
    protected $tag;
    function __construct(TagService $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $tags  = TagResource::collection($this->tag->getAll());
     
        return view('components.admin.table-tag',compact('tags'));
    }
}
