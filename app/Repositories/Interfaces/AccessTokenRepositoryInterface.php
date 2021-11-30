<?php

namespace App\Repositories\Interfaces;

interface AccessTokenRepositoryInterface
{
    public function createTokenForUser($user, $tokenName);

    public function deleteTokenByName($user, $tokenName);
}
