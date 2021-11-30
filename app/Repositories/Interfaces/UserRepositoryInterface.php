<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email);

    /**
     * @param $data
     * @return mixed
     */
    public function createUser($data);
}
