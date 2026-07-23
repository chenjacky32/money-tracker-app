<?php

namespace App\Actions;

use App\DTOs\HomeFilterDTO;
use App\Services\HomeService;

class GetHomeDashboardAction
{
    public function __construct(
        private readonly HomeService $homeService
    ) {}

    public function execute(HomeFilterDTO $filter): array
    {
        return $this->homeService->getDashboardData($filter);
    }
}
