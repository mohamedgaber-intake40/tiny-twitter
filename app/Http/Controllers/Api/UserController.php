<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use App\Services\User\FollowUserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @param User $user
     * @param FollowUserService $followUserService
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function follow(User $user, FollowUserService $followUserService)
    {
        $this->authorize('follow', [User::class, $user]);
        $followUserService->handle([
            'follower_user' => \auth()->user(),
            'followed_user' => $user,
        ]);
        return $this->successResponse([], __('success.users.followed'), Response::HTTP_CREATED);
    }
}
