<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\SocialLogin;
use Illuminate\Support\Facades\Auth;
class SocicalLoginController extends Controller
{

    function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    function facebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $existingUser = SocialLogin::where('user_id', auth()->user()->id)->exists();

        if (!$existingUser) {
           $newUser = SocialLogin::create([
                'social_id' => $user->id,
                'social_type' => 'facebook',
                'user_id' => auth()->user()->id,
            ]);
            Auth::login($newUser);
        }
        Auth::login($existingUser);

        return redirect()->intended('home');
    }
    
}
