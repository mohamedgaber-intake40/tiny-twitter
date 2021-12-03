<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\FollowUserService;
use App\Services\User\UserActionsReportService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @param User $user
     * @param FollowUserService $followUserService
     * @return Application|ResponseFactory|Response
     * @throws AuthorizationException
     */
    public function follow(User $user, FollowUserService $followUserService)
    {
        $this->authorize('follow', [User::class, $user]);
        $followUserService->handle([
            'follower_user' => \auth()->user(),
            'followed_user' => $user,
        ]);
        return response(['message' => __('success.users.followed')]);
    }
}
