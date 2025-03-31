<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
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
        $authHeader = $request->header('Authorization');
        if ($authHeader) {

            list($jwt) = (sscanf($authHeader, 'Bearer %s'));
            $user = $this->accountService->checkToken($jwt);

        }
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
