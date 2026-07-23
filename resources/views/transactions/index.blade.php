<x-app-layout>
    @php
        $groupedTransactions = $transactions->groupBy(function ($item) {
            return $item->date->locale('id')->translatedFormat('l, d M Y');
        });
    @endphp

    <div class="px-6 pb-4">
        <h2 class="text-2xl font-bold text-gray-deep mb-1">Transaksi</h2>
        <p class="text-sm text-gray-medium mb-6">Lacak dan atur transaksi anda.</p>

        <x-ui.month-selector :selectedMonthYear="$selectedMonthYear" />

        <!-- Summary Card -->
        <x-transaction.summary-card :summary="$summary" />

        <!-- Groups -->
        <div class="space-y-6">
            @forelse ($groupedTransactions as $date => $group)
                @php
                    $groupTotal = $group->sum(function ($item) {
                        return $item->transactionType->name === 'pemasukan' ? $item->amount : -$item->amount;
                    });
                    $totalFormatted =
                        $groupTotal < 0
                            ? '- Rp ' . number_format(abs($groupTotal), 0, ',', '.')
                            : '+ Rp ' . number_format($groupTotal, 0, ',', '.');
                @endphp
                <x-transaction.group :date="$date" :totalFormatted="$totalFormatted" :group="$group" />
            @empty
                <div class="text-center py-12 bg-white rounded-2xl border border-gray-200 shadow-sm">
                    <p class="text-gray-medium text-sm">Tidak ada transaksi pada bulan ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
