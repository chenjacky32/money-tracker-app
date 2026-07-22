<?php

namespace App\DTOs\Transaction;

use App\Http\Requests\Transaction\UpdateTransactionRequest;

class UpdateTransactionDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $userId,
        public readonly string $transactionType,
        public readonly int $categoryId,
        public readonly float $amount,
        public readonly string $date,
        public readonly ?string $note
    ) {}

    public static function fromRequest(UpdateTransactionRequest $request, int $id, int $userId): self
    {
        return new self(
            id: $id,
            userId: $userId,
            transactionType: $request->validated('transaction_type'),
            categoryId: (int) $request->validated('category_id'),
            amount: (float) $request->validated('amount'),
            date: $request->validated('date'),
            note: $request->validated('note')
        );
    }
}
