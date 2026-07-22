<?php

namespace App\Actions;

use App\Services\TransactionService;

class DeleteTransactionAction
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {}

    public function execute(int $id, int $userId): bool
    {
        return $this->transactionService->deleteTransaction($id, $userId);
    }
}
