<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Inertia\Middleware;
use Illuminate\Http\Request;

class HandleApiRequests extends Middleware
{


    public function handle(Request $request, Closure $next, $guard=null)
    {

        return $next($request);
    }
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {

    }
}
