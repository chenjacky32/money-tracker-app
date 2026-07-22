<?php

namespace App\Repositories;

use App\DTOs\Transaction\TransactionFilterDTO;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TransactionRepository
{
    public function getHistory(TransactionFilterDTO $filter): Collection
    {
        $query = Transaction::query()
            ->with(['category', 'transactionType'])
            ->where('user_id', $filter->userId);

        if ($filter->month && $filter->year) {
            $query->whereMonth('date', $filter->month)
                ->whereYear('date', $filter->year);
        }

        return $query->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getSummary(TransactionFilterDTO $filter): array
    {
        $query = Transaction::query()
            ->where('user_id', $filter->userId);

        if ($filter->month && $filter->year) {
            $query->whereMonth('date', $filter->month)
                ->whereYear('date', $filter->year);
        }

        $sums = $query->select('transaction_type_id', DB::raw('SUM(amount) as total'))
            ->groupBy('transaction_type_id')
            ->get()
            ->keyBy('transaction_type_id');

        $pemasukanType = TransactionType::where('name', 'pemasukan')->first();
        $pengeluaranType = TransactionType::where('name', 'pengeluaran')->first();

        $pemasukan = $pemasukanType && isset($sums[$pemasukanType->id]) ? (float) $sums[$pemasukanType->id]->total : 0.0;
        $pengeluaran = $pengeluaranType && isset($sums[$pengeluaranType->id]) ? (float) $sums[$pengeluaranType->id]->total : 0.0;

        return [
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'total' => $pemasukan - $pengeluaran,
        ];
    }

    public function findForUser(int $id, int $userId): ?Transaction
    {
        return Transaction::where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }

    public function create(array $data): Transaction
    {
        return Transaction::create($data);
    }

    public function update(Transaction $transaction, array $data): bool
    {
        return $transaction->update($data);
    }

    public function delete(Transaction $transaction): bool
    {
        return $transaction->delete();
    }
}
