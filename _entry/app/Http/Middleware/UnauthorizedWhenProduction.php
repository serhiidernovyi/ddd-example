<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UnauthorizedWhenProduction
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $env = config('app.env');
        if ($env == "production") {
            return $this->unauthorized();
        }

        return $next($request);
    }

    /**
     * @return JsonResponse
     */
    private function unauthorized(): JsonResponse
    {
        return response()->json([
            'code' => ResponseAlias::HTTP_UNAUTHORIZED,
            'message' => 'You are unauthorized to access this resource',
        ], ResponseAlias::HTTP_FORBIDDEN);
    }
}
