<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $followerUser
     * @param User $followedUser
     * @return bool|\Illuminate\Auth\Access\Response
     */
    public function follow(User $followerUser, User $followedUser)
    {

        if ($followerUser->follows()->where('users.id', $followedUser->id)->exists())
            return $this->deny(__('authorization.users.followed_before'));

        if($followedUser->id == $followerUser->id)
            return $this->deny(__('authorization.users.follow_yourself'));

        return true;
    }
}
