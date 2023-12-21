<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\Admin\RoleService;
use App\Http\Resources\RoleResource;
class TablePermission extends Component
{
    /**
     * Create a new component instance.
     */ protected $roleService;
    function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.table-permission');
    }
}
