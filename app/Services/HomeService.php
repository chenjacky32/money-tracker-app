<?php

namespace App\Services;

use App\DTOs\HomeFilterDTO;
use App\DTOs\TransactionFilterDTO;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Carbon;

class HomeService
{
    public function __construct(
        private readonly TransactionRepository $transactionRepo
    ) {}

    public function getDashboardData(HomeFilterDTO $filter): array
    {
        // 1. Get total summary (Saldo, Pemasukan, Pengeluaran)
        $txFilter = new TransactionFilterDTO($filter->userId, $filter->month, $filter->year);
        $summary = $this->transactionRepo->getSummary($txFilter);

        // 2. Get incomes by category
        $incomesRaw = $this->transactionRepo->getCategorySummary(
            $filter->userId,
            'pemasukan',
            $filter->month,
            $filter->year
        );
        $totalIncome = $incomesRaw->sum('nominal');
        $incomes = $incomesRaw->map(function ($item) use ($totalIncome) {
            return [
                'kategori' => $item['kategori'],
                'nominal' => number_format($item['nominal'], 0, ',', '.'),
                'percent' => $totalIncome > 0 ? round(($item['nominal'] / $totalIncome) * 100) : 0,
            ];
        })->toArray();

        // 3. Get expenses by category
        $expensesRaw = $this->transactionRepo->getCategorySummary(
            $filter->userId,
            'pengeluaran',
            $filter->month,
            $filter->year
        );
        $totalExpense = $expensesRaw->sum('nominal');
        $expenses = $expensesRaw->map(function ($item) use ($totalExpense) {
            return [
                'kategori' => $item['kategori'],
                'nominal' => number_format($item['nominal'], 0, ',', '.'),
                'percent' => $totalExpense > 0 ? round(($item['nominal'] / $totalExpense) * 100) : 0,
            ];
        })->toArray();

        // 4. Get last 10 transactions
        $latestRaw = $this->transactionRepo->getLatest($filter->userId, $filter->month, $filter->year, 10);
        $latestTransactions = $latestRaw->map(function ($trx) {
            $date = Carbon::parse($trx->date);
            if ($date->isToday()) {
                $jam = 'Hari ini';
            } elseif ($date->isYesterday()) {
                $jam = 'Kemarin';
            } else {
                $jam = $date->translatedFormat('d M');
            }

            return [
                'nama' => $trx->note ?: $trx->category->name,
                'kategori' => $trx->category->name,
                'nominal' => (float) $trx->amount,
                'tipe' => $trx->transactionType->name,
                'jam' => $jam,
            ];
        })->toArray();

        return [
            'summary' => $summary,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'latestTransactions' => $latestTransactions,
        ];
    }
}
