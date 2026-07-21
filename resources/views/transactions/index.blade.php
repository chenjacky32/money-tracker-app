<x-app-layout>
    @php
        $groupedTransactions = [
            'Senin, 16 Nov 2026' => [
                'total' => '- Rp 100.000',
                'items' => [
                    [
                        'nama' => 'Makan Siang',
                        'kategori' => 'Food',
                        'nominal' => 50000,
                        'tipe' => 'pengeluaran',
                        'jam' => '12.00',
                    ],
                    [
                        'nama' => 'Belanja',
                        'kategori' => 'Groceries',
                        'nominal' => 50000,
                        'tipe' => 'pengeluaran',
                        'jam' => '13.06',
                    ],
                ],
            ],
            'Minggu, 15 Nov 2026' => [
                'total' => '- Rp 100.000',
                'items' => [
                    [
                        'nama' => 'Makan Siang',
                        'kategori' => 'Food',
                        'nominal' => 50000,
                        'tipe' => 'pengeluaran',
                        'jam' => '12.00',
                    ],
                    [
                        'nama' => 'Belanja',
                        'kategori' => 'Groceries',
                        'nominal' => 50000,
                        'tipe' => 'pengeluaran',
                        'jam' => '13.06',
                    ],
                ],
            ],
        ];
    @endphp

    <!-- Header -->
    <div class="px-6 py-5 bg-background sticky top-0 z-40 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-gray-200/50 rounded-full flex items-center justify-center text-primary">
                <x-ui.icon name="user-solid" class="w-4 h-4" />
            </div>
            <h1 class="text-xl font-bold text-primary tracking-tight">Money Tracker</h1>
        </div>
        <button class="w-10 h-10 bg-gray-200/50 rounded-full flex items-center justify-center text-primary">
            <x-ui.icon name="bell" class="w-5 h-5" />
        </button>
    </div>

    <div class="px-6 pb-4">
        <h2 class="text-2xl font-bold text-gray-deep mb-1">Transaksi</h2>
        <p class="text-sm text-gray-medium mb-6">Lacak dan atur transaksi anda.</p>

        <x-ui.month-selector />

        <!-- Summary Card -->
        <div class="bg-white rounded-2xl border border-gray-200 p-4 shadow-sm flex mb-8">
            <div class="flex-1 text-center border-r border-gray-100">
                <p class="text-xs font-bold text-gray-deep mb-1">Pemasukan</p>
                <p class="text-sm font-medium text-primary">13.000.000</p>
            </div>
            <div class="flex-1 text-center border-r border-gray-100">
                <p class="text-xs font-bold text-gray-deep mb-1">Pengeluaran</p>
                <p class="text-sm font-medium text-danger">- 3.000.000</p>
            </div>
            <div class="flex-1 text-center">
                <p class="text-xs font-bold text-gray-deep mb-1">Total</p>
                <p class="text-sm font-medium text-gray-deep">10.000.000</p>
            </div>
        </div>

        <!-- Groups -->
        <div class="space-y-6">
            @foreach ($groupedTransactions as $date => $group)
                <div>
                    <div class="flex justify-between items-end mb-3">
                        <h3 class="text-sm font-medium text-gray-dark">{{ $date }}</h3>
                        <span class="text-sm font-medium text-gray-deep">{{ $group['total'] }}</span>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        @foreach ($group['items'] as $item)
                            <x-transaction.card :nama="$item['nama']" :kategori="$item['kategori']" :nominal="$item['nominal']" :tipe="$item['tipe']"
                                :jam="$item['jam']" />
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
