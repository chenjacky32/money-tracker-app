<x-app-layout>
    @php
        $incomes = [
            ['kategori' => 'Gaji & Bonus', 'nominal' => '12.000k', 'percent' => 95],
            ['kategori' => 'Investasi', 'nominal' => '500k', 'percent' => 15],
        ];
        $expenses = [
            ['kategori' => 'Makanan & Minuman', 'nominal' => '3.500k', 'percent' => 75],
            ['kategori' => 'Transportasi', 'nominal' => '1.200k', 'percent' => 45],
            ['kategori' => 'Belanja', 'nominal' => '800k', 'percent' => 30],
        ];
        $latestTransactions = [
            [
                'nama' => 'Makan Siang Klien',
                'kategori' => 'Makanan & Minuman',
                'nominal' => 250000,
                'tipe' => 'pengeluaran',
                'jam' => 'Hari ini',
            ],
            [
                'nama' => 'Bensin Bulanan',
                'kategori' => 'Transportasi',
                'nominal' => 400000,
                'tipe' => 'pengeluaran',
                'jam' => 'Kemarin',
            ],
            [
                'nama' => 'Gaji November',
                'kategori' => 'Pendapatan',
                'nominal' => 12500000,
                'tipe' => 'pemasukan',
                'jam' => '25 Nov',
            ],
        ];
    @endphp


    <div class="px-5 pt-6 pb-2">
        <x-ui.month-selector />

        <!-- Total Saldo -->
        <div class="bg-info text-white rounded-2xl p-5 shadow-sm mb-5 relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-xs font-bold tracking-wider mb-2 text-primary-dark opacity-90 uppercase">Total Saldo</p>
                <h1 class="text-3xl font-bold text-primary-dark tracking-tight">Rp 45.230.000</h1>
            </div>
            <!-- Bank Icon in background -->
            <div class="absolute right-4 top-4 text-primary-dark opacity-70">
                <x-ui.icon name="bank" class="w-8 h-8" />
            </div>
        </div>

        <!-- Pemasukan & Pengeluaran -->
        <div class="flex gap-4 mb-6">
            <div class="flex-1 bg-white rounded-2xl p-4 shadow-sm border border-gray-200">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center text-white">
                        <x-ui.icon name="arrow-down-long" class="w-4 h-4" />
                    </div>
                    <p class="text-xs font-bold text-gray-darker uppercase tracking-wide">Pemasukan</p>
                </div>
                <p class="font-bold text-primary text-sm tracking-tight">+ Rp 12.500.000</p>
            </div>
            <div class="flex-1 bg-white rounded-2xl p-4 shadow-sm border border-gray-200">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-8 h-8 rounded-full bg-danger-light flex items-center justify-center text-danger">
                        <x-ui.icon name="arrow-up-long" class="w-4 h-4" />
                    </div>
                    <p class="text-xs font-bold text-gray-darker uppercase tracking-wide">Pengeluaran</p>
                </div>
                <p class="font-bold text-danger text-sm tracking-tight">- Rp 8.240.000</p>
            </div>
        </div>

        <!-- Ringkasan Pemasukan -->
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-200 mb-5">
            <div class="flex justify-between items-end mb-4">
                <h3 class="font-bold text-gray-deep leading-tight max-w-[200px]">Pemasukan<br>Berdasarkan
                    Kategori</h3>
                <a href="#" class="text-xs text-info font-medium text-right leading-tight">Lihat<br>Semua</a>
            </div>

            <div class="space-y-4">
                @foreach ($incomes as $inc)
                    <div>
                        <div class="flex justify-between items-end mb-1.5">
                            <span class="text-sm text-gray-medium">{{ $inc['kategori'] }}</span>
                            <span class="text-sm font-bold text-gray-deep">Rp {{ $inc['nominal'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-secondary h-2 rounded-full" style="width: {{ $inc['percent'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Ringkasan Pengeluaran -->
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-200 mb-6">
            <div class="flex justify-between items-end mb-4">
                <h3 class="font-bold text-gray-deep leading-tight max-w-[200px]">Pengeluaran<br>Berdasarkan
                    Kategori</h3>
                <a href="#" class="text-xs text-info font-medium text-right leading-tight">Lihat<br>Semua</a>
            </div>

            <div class="space-y-4">
                @foreach ($expenses as $exp)
                    <div>
                        <div class="flex justify-between items-end mb-1.5">
                            <span class="text-sm text-gray-medium">{{ $exp['kategori'] }}</span>
                            <span class="text-sm font-bold text-gray-deep">Rp {{ $exp['nominal'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-danger h-2 rounded-full" style="width: {{ $exp['percent'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Transaksi Terakhir -->
        <div class="mb-6">
            <div class="flex justify-between items-center mb-4 px-1">
                <h3 class="font-bold text-gray-deep text-lg">Transaksi Terakhir</h3>
                <a href="{{ route('transactions.index') }}" class="text-sm text-info font-medium">Semua</a>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                @foreach ($latestTransactions as $trx)
                    <x-transaction.card :nama="$trx['nama']" :kategori="$trx['kategori']" :nominal="$trx['nominal']" :tipe="$trx['tipe']"
                        :jam="$trx['jam']" />
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
