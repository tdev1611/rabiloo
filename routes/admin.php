<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;

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

Route::group(['prefix' => 'admin-dashboard', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', function () {
        return view('admin.layout');
    })->name('admin.home');

    Route::resource('users', UserController::class, ['as' => 'admin']);
    Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
    Route::get('users/restore/{id}', [UserController::class, 'restore'])->name('admin.users.restore');
    Route::get('users/forceDelete/{id}', [UserController::class, 'forceDelete'])->name('admin.users.forceDelete');

    //role
    Route::resource('roles', RoleController::class, ['as' => 'admin']);
    Route::get('roles/delete/{id}', [RoleController::class, 'delete'])->name('admin.roles.delete');

    //Permission
    Route::resource('permissions', PermissionController::class, ['as' => 'admin']);
    Route::get('permissions/delete/{id}', [PermissionController::class, 'delete'])->name('admin.permissions.delete');


    //categories
    Route::resource('categories', CategoryController::class, ['as' => 'admin']);
    Route::get('categories/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    Route::get('categories/restore/{id}', [CategoryController::class, 'restore'])->name('admin.categories.restore');
    Route::get('categories/forceDelete/{id}', [CategoryController::class, 'forceDelete'])->name('admin.categories.forceDelete');
    // Route::post('categories/action', [CategoryController::class, 'action'])->name('admin.categories.action');



});

Route::group(['prefix' => 'admin-dashboard', 'middleware' => ['auth', 'role:admin|writer']], function () {
    //posts
    Route::resource('posts', PostController::class, ['as' => 'admin']);
    Route::get('posts/delete/{id}', [PostController::class, 'delete'])->name('admin.posts.delete');
    Route::get('posts/restore/{id}', [PostController::class, 'restore'])->name('admin.posts.restore');
    Route::get('posts/forceDelete/{id}', [PostController::class, 'forceDelete'])->name('admin.posts.forceDelete');
});
