<?php

namespace App\Actions;

use App\DTOs\CreateTransactionDTO;
use App\Models\Transaction;
use App\Services\TransactionService;

class CreateTransactionAction
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {}

    public function execute(CreateTransactionDTO $dto, ?string $customCategoryName = null): Transaction
    {
        return $this->transactionService->createTransaction($dto, $customCategoryName);
    }
}
