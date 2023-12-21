<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin-dashboard'], function () {
    Route::get('/', function () {
        return view('admin.layout');
    })->name('admin.home');

    Route::resource('users', UserController::class, ['as' => 'admin']);
    Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete');

    //role
    Route::resource('roles', RoleController::class, ['as' => 'admin']);
    Route::get('roles/delete/{id}', [RoleController::class, 'delete'])->name('admin.roles.delete');

    //Permission
    Route::resource('permissions', PermissionController::class, ['as' => 'admin']);
    Route::get('permissions/delete/{id}', [PermissionController::class, 'delete'])->name('admin.permissions.delete');


    //categories
    Route::resource('categories', CategoryController::class, ['as' => 'admin']);
    Route::get('categories/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
});
