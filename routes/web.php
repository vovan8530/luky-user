<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])
    ->name('dashboard');


require __DIR__.'/auth.php';

