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
        <div class="bg-white rounded-2xl border border-gray-200 p-4 shadow-sm flex mb-8">
            <div class="flex-1 text-center border-r border-gray-100">
                <p class="text-xs font-bold text-gray-deep mb-1">Pemasukan</p>
                <p class="text-sm font-medium text-primary">Rp {{ number_format($summary['pemasukan'], 0, ',', '.') }}
                </p>
            </div>
            <div class="flex-1 text-center border-r border-gray-100">
                <p class="text-xs font-bold text-gray-deep mb-1">Pengeluaran</p>
                <p class="text-sm font-medium text-danger">- Rp {{ number_format($summary['pengeluaran'], 0, ',', '.') }}
                </p>
            </div>
            <div class="flex-1 text-center">
                <p class="text-xs font-bold text-gray-deep mb-1">Total</p>
                <p class="text-sm font-medium text-gray-deep">
                    Rp {{ $summary['total'] < 0 ? '-' : '' }} {{ number_format(abs($summary['total']), 0, ',', '.') }}
                </p>
            </div>
        </div>

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
                <div>
                    <div class="flex justify-between items-end mb-3 mx-2">
                        <h3 class="text-sm font-medium text-gray-dark">{{ $date }}</h3>
                        <span class="text-sm font-medium text-gray-deep">{{ $totalFormatted }}</span>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        @foreach ($group as $item)
                            <button type="button" class="w-full"
                                onclick="window.location.href='{{ route('transactions.edit', $item->id) }}'">
                                <x-transaction.card :nama="$item->note ?? ($item->category->name ?? 'Transaksi')" :kategori="$item->category->name ?? 'Lainnya'" :nominal="$item->amount"
                                    :tipe="$item->transactionType->name" :jam="$item->created_at->format('H.i')" />
                            </button>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-2xl border border-gray-200 shadow-sm">
                    <p class="text-gray-medium text-sm">Tidak ada transaksi pada bulan ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
