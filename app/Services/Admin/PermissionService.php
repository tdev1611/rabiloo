<?php

namespace App\Services\Admin;

use Spatie\Permission\Models\Permission;

use App\Http\Resources\PermissionResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionService
{
    private $permission;
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    function getAll()
    {
        return  PermissionResource::collection($this->permission->oldest('name')->get());
    }



    function find($id)
    {
        $permission = $this->permission->find($id);
        if (!$permission) {
            throw new ModelNotFoundException('not found by ID ' );
        }
        return  $permission;
    }


    function store($data)
    {
        return $this->permission->create($data);
    }

    function getPermissionById($id)
    {
        return  new PermissionResource($this->find($id));
    }

    function update($id, $data)
    {
        $permission = $this->find($id);
        $permission->update($data);
        return $permission;
    }

    function delete($id)
    {
        $permission = Permission::findById($id);
        if ($permission) {
            $permission->delete();
        } else {
            abort(404);
        }
    }
}
