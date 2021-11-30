<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\FollowUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function follow(User $user, FollowUserService $followUserService)
    {
        $this->authorize('follow', [User::class, $user]);
        $followUserService->handle([
            'follower_user' => \auth()->user(),
            'followed_user' => $user,
        ]);
        return response(['message' => 'User Followed Successfully.']);
    }
}
