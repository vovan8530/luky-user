<?php


use App\Http\Controllers\Admin\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [UserController::class, 'index'])->can('view-any', User::class)->name('admin.index');
    Route::get('/{user}', 'Admin\UserController@show')->can('can:view', User::class);
    Route::delete('/{user}', 'Admin\UserController@destroy')->can('delete', User::class);
    Route::delete('/', 'Admin\UserController@destroyMultiple')->can('delete', User::class);
    Route::post('/', 'Admin\UserController@store')->can('create', User::class);
    Route::put('/{user}', 'Admin\UserController@update')->can('update', User::class);
});

