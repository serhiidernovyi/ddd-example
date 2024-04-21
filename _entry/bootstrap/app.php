<?php

use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Lottery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
    )
    ->withRouting(
        api      : __DIR__ . '/../routes/api_v1.php',
        apiPrefix: 'api/v1'
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->throttle(function (Throwable $e) {
            return match (get_class($e)) {
                BroadcastException::class => Limit::perMinute(300),
                default => Limit::none(),
            };
        });
        $exceptions->render(function (Throwable $e) use ($exceptions) {
            return match (get_class($e)) {
                ModelNotFoundException::class => response(['message' => 'Model not found'], Response::HTTP_NOT_FOUND),
                RouteNotFoundException::class => response(['message' => 'Route not found'], Response::HTTP_NOT_FOUND),
                NotFoundHttpException::class => response(['message' => 'Bad Request'], Response::HTTP_BAD_REQUEST),
                MethodNotAllowedHttpException::class => response(['message' => 'Method not allowed'], Response::HTTP_METHOD_NOT_ALLOWED),
                default => response(['message' => 'Exception'], Response::HTTP_I_AM_A_TEAPOT),
            };
        });
    })->create();
