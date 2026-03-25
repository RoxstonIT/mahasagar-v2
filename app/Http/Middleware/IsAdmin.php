<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || !$user->roles->contains('name', 'superadmin')) {
            abort(403);
        }

        return $next($request);
    }
}