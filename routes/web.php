<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecoveryPasswordController;

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('password')->group(function() {
    Route::get('/reset', [RecoveryPasswordController::class, 'showResetForm']);
    Route::post('/email', [RecoveryPasswordController::class, 'sendResetLinkEmail']);
    Route::get('/reset/{token}', [RecoveryPasswordController::class, 'showNewPasswordForm'])->name('password.reset');
    Route::post('/reset', [RecoveryPasswordController::class, 'reset'])->name('password.update');
});

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
