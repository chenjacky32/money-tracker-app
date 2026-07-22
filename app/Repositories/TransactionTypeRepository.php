<?php

namespace App\Repositories;

use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Collection;

class TransactionTypeRepository
{
    public function getAll(): Collection
    {
        return TransactionType::all();
    }

    public function findByName(string $name): ?TransactionType
    {
        return TransactionType::where('name', $name)->first();
    }
}
