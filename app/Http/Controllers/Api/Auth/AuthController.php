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
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * @param RegisterRequest $request
     * @param RegisterService $registerService
     * @return Application|ResponseFactory|Response
     */
    public function register(RegisterRequest $request, RegisterService $registerService)
    {
        ['user' => $user, 'token' => $token] = $registerService->handle($request->validated() + [ 'token_name' => \request()->userAgent() ]);

        return response([
            'data'    => [
                'user'  => [
                    'id' => $user->id,
                    'image' => $user->image_url
                ],
                'token' => TokenResource::make($token),
            ],
            'message' => __('success.auth.register')
        ]);

    }

    /**
     * @param LoginRequest $request
     * @param LoginService $loginService
     * @return TokenResource
     * @throws ValidationException
     */
    public function login(LoginRequest $request, LoginService $loginService)
    {
        $token = $loginService->handle($request->validated() + [ 'token_name' => \request()->userAgent() ]);
        return TokenResource::make($token)->additional(['message' =>  __('success.auth.login')]);
    }

    /**
     * @param LogoutService $logoutService
     * @return Application|ResponseFactory|Response
     */
    public function logout(LogoutService $logoutService)
    {
        $logoutService->handle();
        return response(['message' =>  __('success.auth.logout')]);
    }

}
