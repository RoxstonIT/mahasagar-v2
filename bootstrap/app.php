<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\EnsureSubscriber;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'is_admin' => IsAdmin::class,
            'permission' => CheckPermission::class,
            'subscriber' => EnsureSubscriber::class,
            'verified' => EnsureEmailIsVerified::class,
        ]);

        $middleware->redirectGuestsTo(function (Request $request) {
            if (
                $request->is('subscriber') ||
                $request->is('subscriber/*') ||
                $request->is('login') ||
                $request->is('register') ||
                $request->is('logout') ||
                $request->is('email/verify') ||
                $request->is('email/verify/*') ||
                $request->is('email/verification-notification')
            ) {
                return route('subscriber.login');
            }

            return route('admin.login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
