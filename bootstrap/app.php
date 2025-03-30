<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\HandleApiRequests;
use App\Exceptions\ApplicationException;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Response\JsonResponseDefault;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;

use Illuminate\Validation\ValidationException;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',

        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
        ]);

        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);

        $middleware->api(append: [
            HandleApiRequests::class,
        ]);


    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->report(function (ApplicationException $e) {
            // Дополнительная логика логирования ApplicationException
            Log::info("ApplicationException: message",$e->getMessage());
        });

        $exceptions->report(function (ValidationException  $e) {
            // ...

            dd($e);

        });



    })->create();

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

return $app;
