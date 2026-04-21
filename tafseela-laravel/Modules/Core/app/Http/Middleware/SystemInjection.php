<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Core\System;

class SystemInjection
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if(System::HasResponse())
        {
            return System::GetResponse()->toResponse($request);
        }
        return $response;
    }
}
