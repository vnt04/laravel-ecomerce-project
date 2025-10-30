<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        //
    }

    /**
     * Global render cho tất cả exception
     */
    public function render($request, Throwable $e)
    {
        // Nếu request là API hoặc header Accept: application/json
        if ($request->expectsJson()) {
            $status = 500;
            $message = 'Server Error';
            $errors = [];

            // Validation error
            if ($e instanceof ValidationException) {
                $status = 422;
                $message = 'Validation failed';
                $errors = $e->errors();
            }
            // Authentication 
            elseif ($e instanceof AuthenticationException) {
                $status = 401;
                $message = 'Unauthenticated';            }
            // Model Notfound
            elseif ($e instanceof ModelNotFoundException) {
                $status = 404;
                $message = 'Resource not found';
            }
            // Other HttpException
            elseif ($e instanceof HttpException) {
                $status = $e->getStatusCode();
                $message = $e->getMessage() ?: 'HTTP Error';
            }

            
            $debug = config('app.debug')
                ? [
                    'exception' => get_class($e),
                    'message' => $e->getMessage(),
                    'trace' => collect($e->getTrace())->take(3),
                ]
                : [];

            return response()->json(array_merge([
                'success' => false,
                'message' => $message,
                'errors' => $errors,
            ], $debug), $status);
        }

        // Web request --> default
        return parent::render($request, $e);
    }
}
