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

    /**
     * @param $followerUser
     * @param $followedUser
     * @return mixed|void
     */
    public function followUser($followerUser, $followedUser)
    {
        $followerUser->follows()->attach($followedUser);
    }


    /**
     * @param array $relations
     * @return mixed
     */
    public function getAllWithCount($relations = [])
    {
        return User::withCount($relations)->get();
    }
}
