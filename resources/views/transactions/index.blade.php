<x-app-layout>
    @php
        $groupedTransactions = [
            'Senin, 16 Nov 2026' => [
                'total' => '- Rp 100.000',
                'items' => [
                    ['nama' => 'Makan Siang', 'kategori' => 'Food', 'nominal' => 50000, 'tipe' => 'pengeluaran', 'jam' => '12.00'],
                    ['nama' => 'Belanja', 'kategori' => 'Groceries', 'nominal' => 50000, 'tipe' => 'pengeluaran', 'jam' => '13.06'],
                ]
            ],
            'Minggu, 15 Nov 2026' => [
                'total' => '- Rp 100.000',
                'items' => [
                    ['nama' => 'Makan Siang', 'kategori' => 'Food', 'nominal' => 50000, 'tipe' => 'pengeluaran', 'jam' => '12.00'],
                    ['nama' => 'Belanja', 'kategori' => 'Groceries', 'nominal' => 50000, 'tipe' => 'pengeluaran', 'jam' => '13.06'],
                ]
            ]
        ];
    @endphp

    <!-- Header -->
    <div class="px-6 py-5 bg-[#F8FAFC] sticky top-0 z-40 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-gray-200/50 rounded-full flex items-center justify-center text-primary">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            <h1 class="text-xl font-bold text-primary tracking-tight">Money Tracker</h1>
        </div>
        <button class="w-10 h-10 bg-gray-200/50 rounded-full flex items-center justify-center text-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
        </button>
    </div>

    <div class="px-6 pb-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-1">Transaksi</h2>
        <p class="text-[13px] text-gray-600 mb-6">Lacak dan atur transaksi anda.</p>

        <x-ui.month-selector />

        <!-- Summary Card -->
        <div class="bg-white rounded-2xl border border-gray-200 p-4 shadow-sm flex mb-8">
            <div class="flex-1 text-center border-r border-gray-100">
                <p class="text-[11px] font-bold text-gray-900 mb-1">Pemasukan</p>
                <p class="text-[13px] font-medium text-primary">13.000.000</p>
            </div>
            <div class="flex-1 text-center border-r border-gray-100">
                <p class="text-[11px] font-bold text-gray-900 mb-1">Pengeluaran</p>
                <p class="text-[13px] font-medium text-danger">- 3.000.000</p>
            </div>
            <div class="flex-1 text-center">
                <p class="text-[11px] font-bold text-gray-900 mb-1">Total</p>
                <p class="text-[13px] font-medium text-gray-900">10.000.000</p>
            </div>
        </div>

        <!-- Groups -->
        <div class="space-y-6">
            @foreach($groupedTransactions as $date => $group)
            <div>
                <div class="flex justify-between items-end mb-3">
                    <h3 class="text-sm font-medium text-gray-700">{{ $date }}</h3>
                    <span class="text-sm font-medium text-gray-900">{{ $group['total'] }}</span>
                </div>
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    @foreach($group['items'] as $item)
                        <x-transaction.card 
                            :nama="$item['nama']" 
                            :kategori="$item['kategori']" 
                            :nominal="$item['nominal']" 
                            :tipe="$item['tipe']" 
                            :jam="$item['jam']" 
                        />
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
