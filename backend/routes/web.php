<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

// Registration routes
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register');

// Login and logout routes
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Home route (requires authentication)
Route::get('/home', function () {
    return 'Welcome to the home page!';
})->name('home')->middleware('auth');
