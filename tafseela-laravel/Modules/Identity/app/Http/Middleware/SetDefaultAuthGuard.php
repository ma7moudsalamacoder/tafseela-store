<?php

namespace Modules\Identity\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetDefaultAuthGuard
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->is('api/*')) {
            Auth::setDefaultDriver(auth()->guard('web')->check() ? 'web' : 'sanctum');
        }
        return $next($request);
    }
}
