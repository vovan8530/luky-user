<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::prefix('/user/{user}')->group(function () {
        Route::get('/page-a/', function (Request $request) {
            if (!$request->hasValidSignature()) {
                abort(401);
            }
            $user = $request->user();
            return view('page-a', ['user' => $user]);
        })->name('page-a');

        Route::get('/update-link', [UserController::class, 'updateLink'])->name('update-link');
        Route::get('/deactivate-link', [UserController::class, 'deactivateLink'])->name('deactivate-link');
        Route::get('/lucky', [UserController::class, 'lucky'])->name('lucky');
        Route::get('/history', [UserController::class, 'history'])->name('history');
    });


    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    require __DIR__.'/admin.php';
});
