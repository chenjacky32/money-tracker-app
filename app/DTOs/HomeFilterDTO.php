<?php

namespace App\DTOs;

class HomeFilterDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly ?int $month,
        public readonly ?int $year
    ) {}

    public static function fromRequest(int $userId, ?string $monthYear): self
    {
        $month = null;
        $year = null;

        if ($monthYear && preg_match('/^(\d{2})\/(\d{4})$/', $monthYear, $matches)) {
            $month = (int) $matches[1];
            $year = (int) $matches[2];
        }

        return new self($userId, $month, $year);
    }
}
