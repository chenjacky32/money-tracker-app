<?php

namespace App\Services;

use App\DTOs\ReportFilterDTO;
use App\Repositories\TransactionRepository;

class ReportService
{
    public function __construct(
        private readonly TransactionRepository $transactionRepo
    ) {}

    public function getReportData(ReportFilterDTO $filter): array
    {
        // 1. Get total summary for report (Pemasukan, Pengeluaran, Saldo)
        $summary = $this->transactionRepo->getSummaryForReport(
            $filter->userId,
            $filter->month,
            $filter->year,
            $filter->startDate,
            $filter->endDate
        );

        // 2. Get incomes by category
        $incomesRaw = $this->transactionRepo->getCategorySummary(
            $filter->userId,
            'pemasukan',
            $filter->month,
            $filter->year,
            $filter->startDate,
            $filter->endDate
        );
        $totalIncome = $incomesRaw->sum('nominal');
        $incomes = $incomesRaw->map(function ($item) use ($totalIncome) {
            $percent = $totalIncome > 0 ? ($item['nominal'] / $totalIncome) * 100 : 0;
            $style = $this->getCategoryStyle($item['kategori']);

            return [
                'nama' => $item['kategori'],
                'persen' => round($percent) . '%',
                'percent_num' => round($percent, 2),
                'nominal' => $item['nominal'],
                'nominal_formatted' => number_format($item['nominal'], 0, ',', '.'),
                'bg' => $style['bg'],
                'text' => $style['text'],
                'icon' => $item['icon'] ?: $style['icon'],
            ];
        })->toArray();

        // 3. Get expenses by category
        $expensesRaw = $this->transactionRepo->getCategorySummary(
            $filter->userId,
            'pengeluaran',
            $filter->month,
            $filter->year,
            $filter->startDate,
            $filter->endDate
        );
        $totalExpense = $expensesRaw->sum('nominal');
        $expenses = $expensesRaw->map(function ($item) use ($totalExpense) {
            $percent = $totalExpense > 0 ? ($item['nominal'] / $totalExpense) * 100 : 0;
            $style = $this->getCategoryStyle($item['kategori']);

            return [
                'nama' => $item['kategori'],
                'persen' => round($percent) . '%',
                'percent_num' => round($percent, 2),
                'nominal' => $item['nominal'],
                'nominal_formatted' => number_format($item['nominal'], 0, ',', '.'),
                'bg' => $style['bg'],
                'text' => $style['text'],
                'icon' => $item['icon'] ?: $style['icon'],
            ];
        })->toArray();

        return [
            'summary' => $summary,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'periodType' => $filter->periodType,
            'startDate' => $filter->startDate,
            'endDate' => $filter->endDate,
        ];
    }

    private function getCategoryStyle(string $name): array
    {
        $name = strtolower($name);

        $styles = [
            'tempat tinggal' => ['bg' => 'bg-[#D1E6E2]', 'text' => 'text-primary', 'icon' => 'home'],
            'makanan'        => ['bg' => 'bg-blue-100', 'text' => 'text-blue-500', 'icon' => 'food'],
            'makanan & minuman' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-500', 'icon' => 'food'],
            'transportasi'   => ['bg' => 'bg-orange-100', 'text' => 'text-orange-500', 'icon' => 'transport'],
            'belanja'        => ['bg' => 'bg-[#E5D5C5]', 'text' => 'text-amber-800', 'icon' => 'shopping'],
            'gaji'           => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-600', 'icon' => 'wallet-solid'],
            'gaji & bonus'   => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-600', 'icon' => 'wallet-solid'],
            'investasi'      => ['bg' => 'bg-blue-100', 'text' => 'text-blue-500', 'icon' => 'donut-chart'],
            'sampingan'      => ['bg' => 'bg-purple-100', 'text' => 'text-purple-500', 'icon' => 'other'],
        ];

        return $styles[$name] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-medium', 'icon' => 'other'];
    }
}
