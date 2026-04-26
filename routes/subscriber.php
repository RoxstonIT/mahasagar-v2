<?php

use App\Http\Controllers\Subscriber\AuthController;
use App\Http\Controllers\Subscriber\CommentController;
use App\Http\Controllers\Subscriber\DashboardController;
use App\Http\Controllers\Subscriber\EmailVerificationController;
use App\Http\Controllers\Subscriber\LikedArticleController;
use App\Http\Controllers\Subscriber\SavedArticleController;
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

Route::middleware(['auth', 'subscriber', 'verified'])
    ->prefix('subscriber')
    ->name('subscriber.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/saved-articles', [SavedArticleController::class, 'index'])
            ->name('saved-articles.index');

        Route::post('/articles/{article}/save', [SavedArticleController::class, 'toggle'])
            ->name('articles.save');

        Route::get('/liked-articles', [LikedArticleController::class, 'index'])
            ->name('liked-articles.index');

        Route::post('/articles/{article}/like', [LikedArticleController::class, 'toggle'])
            ->name('articles.like');

        Route::get('/comments', [CommentController::class, 'index'])
            ->name('comments.index');

        Route::post('/articles/{article}/comments', [CommentController::class, 'store'])
            ->name('articles.comments.store');
    });
