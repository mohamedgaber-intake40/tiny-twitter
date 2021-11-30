<?php

namespace App\Traits;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

trait ThrottleLogins
{

    protected function maxAttempts()
    {
        return 5;
    }

    protected function decayMinutes()
    {
        return 30;
    }

    protected function userIdentifier()
    {
        return 'email';
    }

    protected function throttleKey()
    {
        return request($this->userIdentifier()) . '|' . request()->ip();
    }

    protected function hasToManyAttempts()
    {
        return RateLimiter::tooManyAttempts($this->throttleKey(), $this->maxAttempts());
    }

    protected function incrementLoginAttempts()
    {
        RateLimiter::hit($this->throttleKey(), $this->decayMinutes() * 60);
    }

    protected function clearLoginAttempts()
    {
        RateLimiter::clear($this->throttleKey());
    }

    protected function limiterAvailableIn()
    {
        return RateLimiter::availableIn($this->throttleKey());
    }

    protected function sendLockoutResponse()
    {
        throw ValidationException::withMessages([
            $this->userIdentifier() => $this->getLockoutMessage()
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    protected function getLockoutMessage()
    {
        $rateLimiterAvailableIn = $this->limiterAvailableIn();
        return sprintf(
            'To many attempts, you can try in %s minutes and %s seconds.',
            floor($rateLimiterAvailableIn / 60),
            $rateLimiterAvailableIn % 60
        );
    }

}
