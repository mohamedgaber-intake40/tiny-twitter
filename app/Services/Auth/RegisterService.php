<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\Interfaces\AccessTokenRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\AbstractService as Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class RegisterService extends Service
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var AccessTokenRepositoryInterface
     */
    private $tokenRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param AccessTokenRepositoryInterface $tokenRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, AccessTokenRepositoryInterface $tokenRepository)
    {
        $this->userRepository  = $userRepository;
        $this->tokenRepository = $tokenRepository;
    }

    /**
     * @param array|null $data [name,email,password,date_of_birth,image,token_name]
     * @return array
     */
    public function handle(array $data = null)
    {
        $userData = Arr::only($data, [
                'name',
                'email',
                'password',
                'date_of_birth',
            ]
        );

        $userData['image'] = Storage::putFile('images', $data['image']);
        $user              = $this->userRepository->createUser($userData);
        $token             = $this->tokenRepository->createTokenForUser($user, $data['token_name']);

        return compact('user', 'token');
    }
}
