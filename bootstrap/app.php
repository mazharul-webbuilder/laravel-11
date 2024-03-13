<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(
            append: [\App\Http\Middleware\LogRequestEndpoint::class],
            prepend: [\App\Http\Middleware\AddMiddlewareToPrependMiddleware::class]
        )->api(
            append: [],
            prepend: []
        )->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Customize ValidationException response  Custom Request Class
        $exceptions->renderable(function (ValidationException $exception){
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'data' => null,
                'errors' => $exception->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        });
    })->create();
