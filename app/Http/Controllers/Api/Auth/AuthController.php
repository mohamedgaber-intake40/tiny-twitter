<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\TokenResource;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use App\Services\Auth\RegisterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    /**
     * @param RegisterRequest $request
     * @param RegisterService $registerService
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function register(RegisterRequest $request, RegisterService $registerService)
    {
        ['user' => $user, 'token' => $token] = $registerService->handle($request->validated() + ['token_name' => \request()->userAgent()]);
        return $this->successResponse([
            'user'  => [
                'id'    => $user->id,
                'image' => $user->image_url
            ],
            'token' => TokenResource::make($token)
        ], __('success.auth.register'), Response::HTTP_CREATED);
    }

    /**
     * @param LoginRequest $request
     * @param LoginService $loginService
     * @return Application|\Illuminate\Http\Response|ResponseFactory
     * @throws ValidationException
     */
    public function login(LoginRequest $request, LoginService $loginService)
    {
        $token = $loginService->handle($request->validated() + ['token_name' => \request()->userAgent()]);
        return $this->successResponse(TokenResource::make($token), __('success.auth.login'));
    }

    /**
     * @param LogoutService $logoutService
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function logout(LogoutService $logoutService)
    {
        $logoutService->handle();
        return $this->successResponse([], __('success.auth.logout'));
    }

}
