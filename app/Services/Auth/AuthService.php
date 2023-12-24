<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    private $user;
    function __construct(User $user)
    {
        $this->user = $user;
    }


    function register($data)
    {

        return $this->user->create($data);
    }


    // login
    function checkUser($data)
    {
        $user = $this->user->where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new \Exception('The account does not exist on the system');
        }
        Auth::login($user);
        return $user;
    }

}