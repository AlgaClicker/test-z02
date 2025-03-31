<?php

namespace App\Http\Middleware;

use Closure;
use Inertia\Middleware;
use Illuminate\Http\Request;
use Application\Contracts\Services\AccountServiceContract;
use Illuminate\Contracts\Auth\Factory as Auth;

class HandleApiRequests extends Middleware
{

    private AccountServiceContract $accountService;
    protected Auth $auth;
    public function __construct(Auth $auth,AccountServiceContract $accountService)
    {
        $this->accountService = $accountService;
        $this->auth = $auth;
    }
    public function handle(Request $request, Closure $next, $guard=null)
    {
        return $next($request);
    }

}
