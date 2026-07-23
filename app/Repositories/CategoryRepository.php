<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    public function getAllForUser(int $userId): Collection
    {
        return Category::query()
            ->with('transactionType')
            ->where(function ($query) use ($userId) {
                $query->whereNull('user_id')
                      ->orWhere('user_id', $userId);
            })
            ->get();
    }

    public function firstOrCreateCustom(string $name, int $typeId, int $userId): Category
    {
        return Category::firstOrCreate([
            'user_id' => $userId,
            'transaction_type_id' => $typeId,
            'name' => $name,
        ], [
            'icon' => 'other' // default icon for custom categories
        ]);
    }

    public function findById(int $id): ?Category
    {
        return Category::query()->where('id', $id)->first();
    }
}
