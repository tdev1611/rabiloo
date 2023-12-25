<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\LikeController;
use App\Http\Controllers\Client\PostOwnerController;
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



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');


Route::group(['prefix' => 'posts'], function () {
  
    Route::get('/{slug}', [PostController::class, 'show'])->name('client.posts.show');
    
    Route::post('/{post}/comments', [CommentController::class, 'store'])->name('client.comments.store')->middleware('auth');
    Route::post('/{post}/like', [LikeController::class, 'store'])->name('client.likes.store')->middleware('auth');
});
Route::group(['prefix' => '-Bai-viet-cua-ban'], function () {
  
    Route::get('/', [PostOwnerController::class, 'index'])->name('client.postsOwner.index');
    Route::get('/{slug}', [PostOwnerController::class, 'show'])->name('client.postsOwner.show');
});
