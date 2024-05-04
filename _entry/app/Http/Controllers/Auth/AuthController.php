<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Auth\Auth as AuthUseCase;

class AuthController extends Controller
{
    /**
     * @see AuthControllerOA::login()
     */
    public function login(LoginRequest $request, AuthUseCase $useCase): JsonResponse
    {
        $response = $useCase->login($request);
        $resource = new LoginResource($response);
        return $resource->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
