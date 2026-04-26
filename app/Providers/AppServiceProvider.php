<?php

namespace App\Providers;

use App\Observers\PermissionObserver;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Models\Permission;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Permission::observe(PermissionObserver::class);
        View::composer('*', function ($view) {
            $navCategories = Category::query()
                ->orderBy('name')
                ->get();
            $view->with('navCategories', $navCategories);
        });
    }
}
