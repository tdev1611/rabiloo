<?php

namespace App\Services\Admin;

use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $role = $this->role->findOrFail($id);
        if ($role === null) {
            throw new ModelNotFoundException('not found  ID ' );
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
