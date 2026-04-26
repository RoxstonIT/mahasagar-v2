<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomepageController;
use App\Http\Controllers\Web\ArticleController;
use App\Http\Controllers\Web\CategoryController;

Route::get('/', [HomepageController::class, 'index'])->name('home');

Route::get('/category/{slug}', [CategoryController::class, 'show'])
    ->name('category.show');

Route::get('/news/{slug}', [ArticleController::class, 'show'])
    ->name('news.show');

require __DIR__.'/admin.php';