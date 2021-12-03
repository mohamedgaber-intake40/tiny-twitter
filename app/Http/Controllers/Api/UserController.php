<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use App\Services\User\FollowUserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param User $user
     * @param FollowUserService $followUserService
     * @return SuccessResource
     * @throws AuthorizationException
     */
    public function follow(User $user, FollowUserService $followUserService)
    {
        $this->authorize('follow', [User::class, $user]);
        $followUserService->handle([
            'follower_user' => \auth()->user(),
            'followed_user' => $user,
        ]);
        return SuccessResource::make([])
                              ->additional(['message' => __('success.users.followed')]);
    }
}
