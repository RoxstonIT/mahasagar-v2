<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomepageController;
use App\Http\Controllers\Web\ArticleController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\NewsletterController;

Route::get('/', [HomepageController::class, 'index'])->name('home');

Route::get('/category/{slug}', [CategoryController::class, 'show'])
    ->name('category.show');

Route::get('/news/{slug}', [ArticleController::class, 'show'])
    ->name('news.show');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('newsletter.subscribe');

Route::get('/newsletter/verify/{token}', [NewsletterController::class, 'verify'])
    ->name('newsletter.verify');

require __DIR__.'/subscriber.php';
require __DIR__.'/admin.php';
