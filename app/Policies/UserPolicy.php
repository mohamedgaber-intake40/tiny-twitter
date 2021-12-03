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
        //todo move messages to lang files

        if ($followerUser->follows()->where('users.id', $followedUser->id)->exists())
            return $this->deny('already followed before.');

        return true;
    }
}
