<?php

namespace App\Services\Admin;

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
        return $this->role->oldest('name')->get();
    }

    // get status ==1
    function getroleActive()
    {
        return $this->role->where('status', 1)->latest()->get();
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

    function update($id, $data)
    {
        $role = $this->find($id);
        $role->update($data);
        return $role;
    }

    function delete($id)
    {
        $role = $this->find($id);
        return $role->delete();
    }
}
