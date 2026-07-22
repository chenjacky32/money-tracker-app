<?php

namespace App\DTOs;

class ReportFilterDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly string $periodType,
        public readonly ?int $month,
        public readonly ?int $year,
        public readonly ?string $startDate,
        public readonly ?string $endDate
    ) {}

    public static function fromRequest(
        int $userId,
        string $periodType,
        ?string $monthYear,
        ?string $startDate,
        ?string $endDate
    ): self {
        $month = null;
        $year = null;

        if ($monthYear && preg_match('/^(\d{2})\/(\d{4})$/', $monthYear, $matches)) {
            $month = (int) $matches[1];
            $year = (int) $matches[2];
        }

        return new self($userId, $periodType, $month, $year, $startDate, $endDate);
    }
}
