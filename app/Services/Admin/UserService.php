<?php

namespace App\Services\Admin;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserService
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    function getAll()
    {
        return UserResource::collection($this->user->oldest('name')->with('roles')->get());
    }

    function find($id)
    {
        $user = $this->user->find($id);
        if (!$user) {
            throw new ModelNotFoundException('not found  ID ' );
            }
        return $user;
    }

    function store($data)
    {
        return $this->user->create($data);
    }

    function getUserById($id)
    {
        return new UserResource($this->find($id));
    }
    function update($id, $data)
    {
        $user = $this->find($id);
        $password = request()->input('password');
        $data['password'] = ($password != 'default') ? $password : $user->password;

        $user->update($data);
        return $user;
    }

    function delete($id)
    {
        $user = $this->find($id);
        $user->delete();
    }
    function findOnlyTrash($id)
    {
        $user = $this->user->onlyTrashed()->find($id);
        if (!$user) {
            throw new ModelNotFoundException('not found  ID ' );
            }
        return $user;
    }

    function restore($id)
    {
        $user = $this->findOnlyTrash($id);
        return $user->restore();
    }

    function forceDelete($id)
    {
        $user = $this->findOnlyTrash($id);
        return $user->forceDelete();
    }

}
