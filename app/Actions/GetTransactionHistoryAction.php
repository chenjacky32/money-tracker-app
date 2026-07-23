<?php

namespace App\Actions;

use App\DTOs\TransactionFilterDTO;
use App\Services\TransactionService;

class GetTransactionHistoryAction
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {}

    public function execute(TransactionFilterDTO $filter): array
    {
        $transactions = $this->transactionService->getHistory($filter);
        $summary = $this->transactionService->getSummary($filter);

        return [
            'transactions' => $transactions,
            'summary' => $summary,
        ];
    }
}
