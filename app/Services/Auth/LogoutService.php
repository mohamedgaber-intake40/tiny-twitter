<?php

namespace App\Services\Auth;

use App\Services\AbstractService as Service;

class LogoutService extends Service
{
    /**
     * @param array|null $data
     * @return mixed|void
     */
    public function handle(array $data = null)
    {
        \request()->user()->currentAccessToken()->delete();
    }
}
