<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\Admin\PermissionService;
use App\Http\Resources\PermissionResource;

class TablePermission extends Component
{
    /**
     * Create a new component instance.
     */ protected $permissionService;
    function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $permissions  = PermissionResource::collection($this->permissionService->getAll());
        return view('components.admin.table-permission', compact('permissions'));
    }
}
