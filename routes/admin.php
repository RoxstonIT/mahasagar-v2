<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix('admin')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth', 'is_admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('categories')->group(function () {

            Route::get('/', [CategoryController::class, 'index'])
                ->middleware('permission:view_categories')
                ->name('admin.categories.index');

            Route::get('/create', [CategoryController::class, 'create'])
                ->middleware('permission:create_category')
                ->name('admin.categories.create');

            Route::post('/', [CategoryController::class, 'store'])
                ->middleware('permission:create_category')
                ->name('admin.categories.store');

            Route::get('/{category}/edit', [CategoryController::class, 'edit'])
                ->middleware('permission:edit_category')
                ->name('admin.categories.edit');

            Route::put('/{category}', [CategoryController::class, 'update'])
                ->middleware('permission:edit_category')
                ->name('admin.categories.update');

            Route::delete('/{category}', [CategoryController::class, 'destroy'])
                ->middleware('permission:delete_category')
                ->name('admin.categories.destroy');
        });

    });

});