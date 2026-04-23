<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;

Route::prefix('admin')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth', 'is_admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('categories')->group(function () {

            /**
             * Category Management Routes
             * - List Categories: GET /admin/categories
             * - Create Category: GET /admin/categories/create
             * - Store Category: POST /admin/categories
             * - Edit Category: GET /admin/categories/{category}/edit
             * - Update Category: PUT /admin/categories/{category}
             * - Delete Category: DELETE /admin/categories/{category}
             * Each route is protected by specific permissions to ensure that only authorized users can perform these actions.
            */
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

        /**
         * Article Management Routes
         * - List Articles: GET /admin/articles
         * - Create Article: GET /admin/articles/create
         * - Store Article: POST /admin/articles
         * - Edit Article: GET /admin/articles/{id}/edit
         * - Update Article: PUT /admin/articles/{id}
         * - Delete Article: DELETE /admin/articles/{id}
         * Each route is protected by specific permissions to ensure that only authorized users can perform these actions, especially considering the approval workflow for news articles.
         * Permissions:
         * - submit_news_article: Allows users to submit new articles for review.
         * - edit_news_article_before_approval: Allows users to edit their submitted articles before they are approved by an admin.
         * - delete_news_article_before_approval: Allows users to delete their submitted articles before they are approved by an admin.
         * - approve_news_article: Allows admins to approve submitted articles, making them visible to the public.
         * - reject_news_article: Allows admins to reject submitted articles, preventing them from being published.
         * - edit_news_article_after_approval: Allows admins to edit articles even after they have been approved and published.
         * - delete_news_article_after_approval: Allows admins to delete articles even after they have been approved and published.
        */
        Route::prefix('articles')->group(function () {

            Route::get('/', [ArticleController::class, 'index'])
                ->name('admin.articles.index')
                ->middleware('permission:submit_news_article');

            Route::get('/create', [ArticleController::class, 'create'])
                ->name('admin.articles.create')
                ->middleware('permission:submit_news_article');

            Route::post('/', [ArticleController::class, 'store'])
                ->name('admin.articles.store')
                ->middleware('permission:submit_news_article');

            Route::get('/{id}/edit', [ArticleController::class, 'edit'])
                ->name('admin.articles.edit')
                ->middleware('permission:edit_news_article_before_approval');

            Route::put('/{id}', [ArticleController::class, 'update'])
                ->name('admin.articles.update')
                ->middleware('permission:edit_news_article_before_approval');

            Route::delete('/{id}', [ArticleController::class, 'destroy'])
                ->name('admin.articles.destroy')
                ->middleware('permission:delete_news_article_before_approval');

            Route::post('/upload-image', [ArticleController::class, 'uploadImage'])
                ->name('admin.articles.upload-image')
                ->middleware('permission:submit_news_article');

        });

    });

});