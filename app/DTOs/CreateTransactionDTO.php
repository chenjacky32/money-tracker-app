<?php

namespace App\DTOs;

use App\Http\Requests\Transaction\StoreTransactionRequest;

class CreateTransactionDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly string $transactionType,
        public readonly int $categoryId,
        public readonly float $amount,
        public readonly string $date,
        public readonly ?string $note
    ) {}

    public static function fromRequest(StoreTransactionRequest $request, int $userId): self
    {
        return new self(
            userId: $userId,
            transactionType: $request->validated('transaction_type'),
            categoryId: (int) $request->validated('category_id'),
            amount: (float) $request->validated('amount'),
            date: $request->validated('date'),
            note: $request->validated('note')
        );
    }
}
