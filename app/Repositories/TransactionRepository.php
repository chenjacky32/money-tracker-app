<?php

namespace App\Repositories;

use App\DTOs\TransactionFilterDTO;
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

        $pemasukanType = TransactionType::query()->where('name', 'pemasukan')->first();
        $pengeluaranType = TransactionType::query()->where('name', 'pengeluaran')->first();

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
        return Transaction::query()->where('id', $id)
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

    public function getCategorySummary(
        int $userId,
        string $type,
        ?int $month = null,
        ?int $year = null,
        ?string $startDate = null,
        ?string $endDate = null
    ): \Illuminate\Support\Collection {
        $query = Transaction::query()
            ->select('category_id', DB::raw('SUM(amount) as nominal'))
            ->where('user_id', $userId)
            ->whereHas('transactionType', function ($q) use ($type) {
                $q->where('name', $type);
            });

        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        } elseif ($month && $year) {
            $query->whereMonth('date', $month)
                ->whereYear('date', $year);
        }

        return $query->groupBy('category_id')
            ->get()
            ->map(function ($item) {
                return [
                    'kategori' => $item->category?->name ?? 'Lainnya',
                    'nominal' => (float) $item->nominal,
                    'category_id' => $item->category_id,
                    'icon' => $item->category?->icon ?? 'other',
                ];
            })
            ->sortByDesc('nominal')
            ->values();
    }

    public function getLatest(int $userId, ?int $month = null, ?int $year = null, int $limit = 10): Collection
    {
        $query = Transaction::query()
            ->with(['category', 'transactionType'])
            ->where('user_id', $userId);

        if ($month && $year) {
            $query->whereMonth('date', $month)
                ->whereYear('date', $year);
        }

        return $query->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getSummaryForReport(
        int $userId,
        ?int $month = null,
        ?int $year = null,
        ?string $startDate = null,
        ?string $endDate = null
    ): array {
        $query = Transaction::query()
            ->where('user_id', $userId);

        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        } elseif ($month && $year) {
            $query->whereMonth('date', $month)
                ->whereYear('date', $year);
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
}
