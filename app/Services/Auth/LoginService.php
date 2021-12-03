<?php

namespace App\Services\Auth;

use App\Repositories\Interfaces\AccessTokenRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\AbstractService as Service;
use App\Traits\ThrottleLogins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginService extends Service
{
    use ThrottleLogins;
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
     * @param array|null $data [email,password,token_name]
     * @return mixed
     * @throws ValidationException
     */
    public function handle(array $data = null)
    {
        if ($this->hasToManyAttempts())
            $this->sendLockoutResponse();

        $user = $this->userRepository->getUserByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            $this->incrementLoginAttempts();
            throw ValidationException::withMessages(['message' => __('auth.failed')]);
        }
        $this->clearLoginAttempts();
        $this->tokenRepository->deleteTokenByName($user, $data['token_name']);
        return $this->tokenRepository->createTokenForUser($user, $data['token_name']);
    }

}
