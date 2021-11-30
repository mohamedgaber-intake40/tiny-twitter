<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AccessTokenRepositoryInterface;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    /**
     * @param $user
     * @param $tokenName
     * @return mixed
     */
    public function createTokenForUser($user, $tokenName)
    {
        return $user->createToken($tokenName);
    }

    /**
     * @param $user
     * @param $tokenName
     * @return mixed
     */
    public function deleteTokenByName($user, $tokenName)
    {
        return $user->tokens()->where('name',$tokenName)->delete();
    }
}
