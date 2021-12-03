<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\User\UserActionsReportService;

class ReportController extends Controller
{
    public function __invoke(UserActionsReportService $userActionsReportService)
    {
        $pdf = $userActionsReportService->handle();
        return $pdf->download('user-actions-report.pdf');
    }
}
