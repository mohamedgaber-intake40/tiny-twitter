<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\TokenResource;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    /**
     * @param RegisterRequest $request
     * @param RegisterService $registerService
     * @return JsonResponse|object
     */
    public function register(RegisterRequest $request, RegisterService $registerService)
    {
        ['user' => $user, 'token' => $token] = $registerService->handle($request->validated() + ['token_name' => \request()->userAgent()]);

        return SuccessResource::make([
            'user'  => [
                'id'    => $user->id,
                'image' => $user->image_url
            ],
            'token' => TokenResource::make($token),
        ])->additional(['message' => __('success.auth.register')])
          ->response()
          ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param LoginRequest $request
     * @param LoginService $loginService
     * @return TokenResource
     * @throws ValidationException
     */
    public function login(LoginRequest $request, LoginService $loginService)
    {
        $token = $loginService->handle($request->validated() + ['token_name' => \request()->userAgent()]);
        return TokenResource::make($token)
                            ->additional(['message' => __('success.auth.login')]);
    }

    /**
     * @param LogoutService $logoutService
     * @return SuccessResource
     */
    public function logout(LogoutService $logoutService)
    {
        $logoutService->handle();
        return SuccessResource::make([])
                              ->additional(['message' => __('success.auth.logout')]);
    }

}
