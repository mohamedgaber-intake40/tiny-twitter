<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email)
    {
        return User::where('email',$email)->first();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createUser($data)
    {
        return User::create($data);
    }

}
