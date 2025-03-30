<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

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
        // Пример кастомной обработки исключения валидации для API-запросов
        if ($exception instanceof ValidationException && $request->expectsJson()) {
            return response()->json([
                'success' => false,
                'data'    => $exception->errors(),
                'message' => 'Validation error',
                'code'    => 422,
            ], 422);
        }

        // Можно добавить и другие проверки для конкретных типов исключений

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
