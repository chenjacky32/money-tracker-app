<?php

namespace App\Actions\Transaction;

use App\DTOs\Transaction\UpdateTransactionDTO;
use App\Services\TransactionService;

class UpdateTransactionAction
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {}

    public function execute(UpdateTransactionDTO $dto, ?string $customCategoryName = null): bool
    {
        return $this->transactionService->updateTransaction($dto, $customCategoryName);
    }
}
