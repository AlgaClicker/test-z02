<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Inertia\Inertia;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
class Handler extends ExceptionHandler
{
    /**
     * Список исключений, которые не нужно логировать.
     *
     * @var array
     */
    protected $dontReport = [
        // Добавьте сюда исключения, которые не должны логироваться
    ];

    /**
     * Список входных данных, которые никогда не должны сохраняться в сессии при валидации.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Сообщение об ошибке.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception): Response
    {
        $response = parent::render($request, $exception);
        if (!$exception->getCode() || $exception->getCode() === 0) {
            $code = 500;
        } else {
            $code = $exception->getCode();
        }



        if ($exception instanceof ValidationException ) {
            return back()->with([]);
            return response()->json([
                'success' => false,
                'data'    => $exception->errors(),
                'message' => 'Validation error',
                'code'    => $code,
            ], $code);
        }

        if ($exception instanceof HttpException ) {
            return response()->json([
                'success' => false,
                'data'    => $exception->getCode(),
                'message' => $exception->getMessage(),
                'code'    => $code,
            ], $code);
        }

        if ($exception instanceof \ErrorException  ) {

        }



        return parent::render($request, $exception);
    }

    /**
     * Логирование исключений.
     *
     * @param \Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // Здесь можно отправлять исключения в внешние сервисы, например, Sentry, Bugsnag и т.д.
        parent::report($exception);
    }
}
