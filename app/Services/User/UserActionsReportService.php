<?php

namespace App\Services\User;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\AbstractService as Service;

class UserActionsReportService extends Service
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository  = $userRepository;
    }

    public function handle(array $data = null)
    {
        return \PDF::loadView('pdf.actions-report-template', $this->getPdfData());
    }

    private function getPdfData()
    {
        $users            = $this->userRepository->getAllWithCount('tweets');
        $tweetsPerUserAvg = $users->count() > 0 ? round($users->sum('tweets_count') / $users->count(),2 ) : 0;
        return compact('users', 'tweetsPerUserAvg');
    }
}
