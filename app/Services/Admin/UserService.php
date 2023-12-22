<?php

namespace App\Services\Admin;

use App\Http\Resources\userResource;
use App\Models\User;


class UserService
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    function getAll()
    {
        return  UserResource::collection($this->user->oldest('name')->get());
    }

    function find($id)
    {
        $user = $this->user->find($id);
        if ($user === null) {
            abort(404);
        }
        return $user;
    }

    function store($data)
    {
        return $this->user->create($data);
    }

    function getuserById($id)
    {
        return  new userResource($this->find($id));
    }
    function update($id, $data)
    {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }

    function delete($id)
    {
        $user = user::findById($id);
        if ($user) {
            $user->delete();
        } else {
            abort(404);
        }
    }
}
