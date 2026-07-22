<x-app-layout>
    @php
        $categories = [
            [
                'nama' => 'Tempat Tinggal',
                'persen' => '40%',
                'nominal' => '4.960.000',
                'bg' => 'bg-[#D1E6E2]',
                'text' => 'text-primary',
                'icon' => 'home',
            ],
            [
                'nama' => 'Makanan',
                'persen' => '20%',
                'nominal' => '2.480.000',
                'bg' => 'bg-blue-100',
                'text' => 'text-blue-500',
                'icon' => 'food',
            ],
            [
                'nama' => 'Transportasi',
                'persen' => '15%',
                'nominal' => '1.860.000',
                'bg' => 'bg-orange-100',
                'text' => 'text-orange-500',
                'icon' => 'transport',
            ],
            [
                'nama' => 'Belanja',
                'persen' => '15%',
                'nominal' => '1.860.000',
                'bg' => 'bg-[#E5D5C5]',
                'text' => 'text-amber-800',
                'icon' => 'shopping',
            ],
        ];
    @endphp

    <div x-data="reportsLogic" class="min-h-screen">
        <div class="px-6 py-5 bg-background sticky top-0 z-20">
            <h2 class="text-2xl font-bold text-gray-deep mb-6">Laporan</h2>

            <!-- Period Tabs -->
            <div class="flex bg-gray-200/60 p-1 rounded-xl mb-4">
                <button type="button" @click="SelectedPeriodType = 'bulanan'"
                    :class="SelectedPeriodType === 'bulanan' ? 'bg-white text-gray-deep shadow-sm rounded-lg' :
                        'text-gray-light hover:text-gray-deep'"
                    class="flex-1 py-1.5 text-sm font-semibold transition cursor-pointer">Bulanan</button>
                <button type="button" @click="SelectedPeriodType = 'rentang_tanggal'"
                    :class="SelectedPeriodType === 'rentang_tanggal' ? 'bg-white text-gray-deep shadow-sm rounded-lg' :
                        'text-gray-light hover:text-gray-deep'"
                    class="flex-1 py-1.5 text-sm font-semibold transition cursor-pointer">Rentang Tanggal</button>
            </div>

            <div x-show="SelectedPeriodType === 'bulanan'" x-transition>
                <x-ui.month-selector />
            </div>

            <div x-show="SelectedPeriodType === 'rentang_tanggal'" x-transition x-cloak>
                <x-ui.date-range-selector />
            </div>

            <!-- Type Tabs -->
            <div class="flex gap-4 border-b border-gray-200 mb-6 px-2">
                <button type="button" @click="SelectedTransactionType = 'pemasukan'"
                    :class="SelectedTransactionType === 'pemasukan' ? 'text-primary border-b-2 border-primary font-bold' :
                        'text-gray-light border-b-2 border-transparent font-medium'"
                    class="pb-3 text-sm transition cursor-pointer">Pemasukan</button>
                <button type="button" @click="SelectedTransactionType = 'pengeluaran'"
                    :class="SelectedTransactionType === 'pengeluaran' ? 'text-primary border-b-2 border-primary font-bold' :
                        'text-gray-light border-b-2 border-transparent font-medium'"
                    class="pb-3 text-sm transition cursor-pointer">Pengeluaran</button>
            </div>
        </div>

        <div class="px-6 pb-24">
            <!-- Donut Chart Area -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-200 mb-8 flex justify-center relative">
                <div class="relative w-48 h-48">
                    <!-- ChartJS Canvas -->
                    <canvas id="pieChart" class="w-full h-full"></canvas>

                    <!-- Inner Text -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <p class="text-xs font-bold text-gray-light uppercase tracking-wide">Total</p>
                        <p class="text-xl font-bold text-gray-deep mt-1"
                            x-text="SelectedTransactionType === 'pemasukan' ? 'Rp 5.400.000' : 'Rp 12.400.000'"></p>
                    </div>
                </div>
            </div>

            <!-- Rincian Kategori - Pengeluaran -->
            <div x-show="SelectedTransactionType === 'pengeluaran'" x-transition>
                <h3 class="font-bold text-gray-deep mb-4 text-lg">Rincian Kategori</h3>

                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    @foreach ($categories as $cat)
                        <div class="p-4 border-b border-gray-100 last:border-0 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 {{ $cat['bg'] }} rounded-full flex items-center justify-center {{ $cat['text'] }}">
                                    <x-ui.icon name="{{ $cat['icon'] }}" class="w-5 h-5" />
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-deep">{{ $cat['nama'] }}</p>
                                    <p class="text-xs font-medium text-gray-light">{{ $cat['persen'] }}</p>
                                </div>
                            </div>
                            <p class="text-sm font-bold text-danger">- Rp {{ $cat['nominal'] }}</p>
                        </div>
                    @endforeach

                    <div class="p-4 border-b border-gray-100 last:border-0 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-medium">
                                <x-ui.icon name="other" class="w-5 h-5" />
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-deep">Lainnya</p>
                                <p class="text-xs font-medium text-gray-light">10%</p>
                            </div>
                        </div>
                        <p class="text-sm font-bold text-danger">- Rp 1.240.000</p>
                    </div>
                </div>
            </div>

            <!-- Rincian Kategori - Pemasukan -->
            <div x-show="SelectedTransactionType === 'pemasukan'" x-transition x-cloak>
                <h3 class="font-bold text-gray-deep mb-4 text-lg">Rincian Kategori</h3>

                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <!-- Gaji -->
                    <div class="p-4 border-b border-gray-100 last:border-0 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600">
                                <x-ui.icon name="wallet-solid" class="w-5 h-5" />
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-deep">Gaji</p>
                                <p class="text-xs font-medium text-gray-light">60%</p>
                            </div>
                        </div>
                        <p class="text-sm font-bold text-secondary">+ Rp 3.240.000</p>
                    </div>
                    <!-- Investasi -->
                    <div class="p-4 border-b border-gray-100 last:border-0 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-500">
                                <x-ui.icon name="donut-chart" class="w-5 h-5" />
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-deep">Investasi</p>
                                <p class="text-xs font-medium text-gray-light">25%</p>
                            </div>
                        </div>
                        <p class="text-sm font-bold text-secondary">+ Rp 1.350.000</p>
                    </div>
                    <!-- Sampingan -->
                    <div class="p-4 border-b border-gray-100 last:border-0 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-500">
                                <x-ui.icon name="other" class="w-5 h-5" />
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-deep">Sampingan</p>
                                <p class="text-xs font-medium text-gray-light">15%</p>
                            </div>
                        </div>
                        <p class="text-sm font-bold text-secondary">+ Rp 810.000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
