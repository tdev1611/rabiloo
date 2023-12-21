<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteRecord extends Component
{
    /**
     * Create a new component instance.
     */
    public $category;
    public $deleteRoute;
    public $modelType;
    public function __construct($category, $deleteRoute, $modelType)
    {
        $this->category = $category;
        $this->deleteRoute = $deleteRoute;
        $this->modelType = $modelType;
       
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.delete-record');
    }
}
