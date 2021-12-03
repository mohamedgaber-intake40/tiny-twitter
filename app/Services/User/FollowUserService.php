<?php

namespace App\Services\User;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\AbstractService as Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class FollowUserService extends Service
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array|null $data [follower_user,followed_user]
     * @return mixed|void
     */
    public function handle(array $data = null)
    {
        return $this->userRepository->followUser($data['follower_user'], $data['followed_user']);
    }
}
