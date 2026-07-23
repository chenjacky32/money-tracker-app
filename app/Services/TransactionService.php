<?php

namespace App\Services;

use App\DTOs\CreateTransactionDTO;
use App\DTOs\TransactionFilterDTO;
use App\DTOs\UpdateTransactionDTO;
use App\Models\Category;
use App\Models\Transaction;
use App\Repositories\CategoryRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\TransactionTypeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class TransactionService
{
    public function __construct(
        private readonly TransactionRepository $transactionRepo,
        private readonly CategoryRepository $categoryRepo,
        private readonly TransactionTypeRepository $typeRepo
    ) {}

    public function getHistory(TransactionFilterDTO $filter): Collection
    {
        return $this->transactionRepo->getHistory($filter);
    }

    public function getSummary(TransactionFilterDTO $filter): array
    {
        return $this->transactionRepo->getSummary($filter);
    }

    public function getTransactionForUser(int $id, int $userId): ?Transaction
    {
        return $this->transactionRepo->findForUser($id, $userId);
    }

    public function createTransaction(CreateTransactionDTO $dto, ?string $customCategoryName = null): Transaction
    {
        // 1. Resolve Transaction Type ID
        $type = $this->typeRepo->findByName($dto->transactionType);
        if (!$type) {
            throw new \InvalidArgumentException("Transaction type '{$dto->transactionType}' not found.");
        }

        // 2. Resolve Category ID (Handle custom category if category is "Lainnya" and name is provided)
        $categoryId = $dto->categoryId;
        $lainnyaCategory = $this->categoryRepo->findById($categoryId);

        if ($lainnyaCategory && strtolower($lainnyaCategory->name) === 'lainnya' && !empty($customCategoryName)) {
            $customCategory = $this->categoryRepo->firstOrCreateCustom(
                name: trim($customCategoryName),
                typeId: $type->id,
                userId: $dto->userId
            );
            $categoryId = $customCategory->id;
        }

        // 3. Create Transaction
        return $this->transactionRepo->create([
            'user_id' => $dto->userId,
            'category_id' => $categoryId,
            'transaction_type_id' => $type->id,
            'amount' => $dto->amount,
            'date' => $dto->date,
            'note' => $dto->note,
        ]);
    }

    public function updateTransaction(UpdateTransactionDTO $dto, ?string $customCategoryName = null): bool
    {
        $transaction = $this->transactionRepo->findForUser($dto->id, $dto->userId);
        if (!$transaction) {
            throw new \Exception("Transaction not found or unauthorized.");
        }

        // 1. Resolve Transaction Type ID
        $type = $this->typeRepo->findByName($dto->transactionType);
        if (!$type) {
            throw new \InvalidArgumentException("Transaction type '{$dto->transactionType}' not found.");
        }

        // 2. Resolve Category ID (Handle custom category if category is "Lainnya" and name is provided)
        $categoryId = $dto->categoryId;
        $lainnyaCategory = $this->categoryRepo->findById($categoryId);

        if ($lainnyaCategory && strtolower($lainnyaCategory->name) === 'lainnya' && !empty($customCategoryName)) {
            $customCategory = $this->categoryRepo->firstOrCreateCustom(
                name: trim($customCategoryName),
                typeId: $type->id,
                userId: $dto->userId
            );
            $categoryId = $customCategory->id;
        }

        // 3. Update
        return $this->transactionRepo->update($transaction, [
            'category_id' => $categoryId,
            'transaction_type_id' => $type->id,
            'amount' => $dto->amount,
            'date' => $dto->date,
            'note' => $dto->note,
        ]);
    }

    public function deleteTransaction(int $id, int $userId): bool
    {
        $transaction = $this->transactionRepo->findForUser($id, $userId);
        if (!$transaction) {
            throw new \Exception("Transaction not found or unauthorized.");
        }

        return $this->transactionRepo->delete($transaction);
    }
}
