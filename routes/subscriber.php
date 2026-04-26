<?php

use App\Http\Controllers\Subscriber\AuthController;
use App\Http\Controllers\Subscriber\DashboardController;
use App\Http\Controllers\Subscriber\EmailVerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('subscriber.login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('subscriber.login.submit');

Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('subscriber.register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('subscriber.register.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('subscriber.logout');

Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/subscriber/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'subscriber', 'verified'])
    ->name('subscriber.dashboard');
