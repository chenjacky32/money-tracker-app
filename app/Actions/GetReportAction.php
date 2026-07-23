<?php

namespace App\Actions;

use App\DTOs\ReportFilterDTO;
use App\Services\ReportService;

class GetReportAction
{
    public function __construct(
        private readonly ReportService $reportService
    ) {}

    public function execute(ReportFilterDTO $filter): array
    {
        return $this->reportService->getReportData($filter);
    }
}
