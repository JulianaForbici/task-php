<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('home');

    Route::resource('tasks', TaskController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
});

Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register', Register::class)
    ->middleware('guest');

Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', Login::class)
    ->middleware('guest');

Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');