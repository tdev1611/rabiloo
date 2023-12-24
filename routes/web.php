<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\LikeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('', [HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'posts'], function () {
    Route::get('/{slug}', [PostController::class, 'show'])->name('client.posts.show');
    Route::post('/{post}/comments', [CommentController::class, 'store'])->name('client.comments.store');
    Route::post('/{post}/like', [LikeController::class, 'store'])->name('client.likes.store');
});
