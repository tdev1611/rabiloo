<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
class AuthController extends Controller
{

    protected $authService;
    function __construct(AuthService $authService)
    {
        $this->authService = $authService;

    }

    function showRegisterForm()
    {
        return auth()->user() ? redirect(route('home'))
            : view('auth.register');
    }
    //  register
    function register(RegisterRequest $request)
    {
        $data = $request->validated();
        try {
            // register
            $user = $this->authService->register($data);
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Register Success',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

    // login-form

    function showLoginForm()
    {
        return auth()->user() ? redirect(route('home'))
            : view('auth.login');
    }

    // login
    function login(LoginRequest $request)
    {
        $data = $request->validated();
        try {
            // login
            $user = $this->authService->checkUser($data);

            return response()->json([
                'success' => true,
                'message' => 'login Success',
                'redirect' => redirect()->intended()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

    function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
