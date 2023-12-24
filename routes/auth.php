<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocicalLoginController;


Route::group(['prefix' => 'auth'], function () {

    // facebook
    Route::get('/facebook/redirect', [SocicalLoginController::class, 'facebookRedirect'])->name('auth.redirect.fb');
    Route::get('/facebook/callback', [SocicalLoginController::class, 'facebookCallback'])->name('auth.callback.fb');
    
 
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');


// register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register.form');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');





