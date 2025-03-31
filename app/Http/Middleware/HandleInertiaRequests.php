<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     * @throws ApplicationException
     */


    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        if ($request->method()=="POST") {
            //dd($request);
        }

        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [

        ]);
    }
    protected function redirectTo($request)
    {
        // Если запрос ожидает JSON (API или Inertia)
        if ($request->expectsJson()) {
            // Можно вернуть ошибку, чтобы не было редиректа
            abort(401, 'Unauthenticated');
        }

        // Иначе отправляем на страницу логина (или другую, по желанию)
        return route('login');
    }
}
