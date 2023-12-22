<?php

namespace App\Services\Admin;

use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Role;


class RoleService
{
    private $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    function getAll()
    {
        return  RoleResource::collection($this->role->oldest('name')->get());
    }

    function find($id)
    {
        $role = $this->role->find($id);
        if ($role === null) {
            abort(404);
        }
        return $role;
    }

    function store($data)
    {
        return $this->role->create($data);
    }

    function getRoleById($id)
    {
        return  new RoleResource($this->find($id));
    }
    function update($id, $data)
    {
        $role = $this->find($id);
        $role->update($data);
        return $role;
    }

    function delete($id)
    {
        $role = Role::findById($id);
        if ($role) {
            $role->delete();
        } else {
            abort(404);
        }
    }
}
