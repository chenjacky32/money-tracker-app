<x-app-layout>
    <div x-data='reportsLogic(@json($incomes), @json($expenses), @json($summary), "{{ $periodType }}", "{{ $startDate }}", "{{ $endDate }}", "{{ $selectedMonthYear }}")'
        class="min-h-screen">
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
                <x-ui.month-selector :selectedMonthYear="$selectedMonthYear" />
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
                            x-text="SelectedTransactionType === 'pemasukan' ? 'Rp ' + formatRupiah(summary.pemasukan) : 'Rp ' + formatRupiah(summary.pengeluaran)">
                        </p>
                    </div>
                </div>
            </div>

            <!-- Rincian Kategori - Pengeluaran -->
            <div x-show="SelectedTransactionType === 'pengeluaran'" x-transition>
                <h3 class="font-bold text-gray-deep mb-4 text-lg">Rincian Kategori</h3>

                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    @forelse ($expenses as $exp)
                        <div class="p-4 border-b border-gray-100 last:border-0 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 {{ $exp['bg'] }} rounded-full flex items-center justify-center {{ $exp['text'] }}">
                                    <x-ui.icon name="{{ $exp['icon'] }}" class="w-5 h-5" />
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-deep">{{ $exp['nama'] }}</p>
                                    <p class="text-xs font-medium text-gray-light">{{ $exp['persen'] }}</p>
                                </div>
                            </div>
                            <p class="text-sm font-bold text-danger">- Rp {{ $exp['nominal_formatted'] }}</p>
                        </div>
                    @empty
                        <div class="p-6 text-center text-sm text-gray-medium">
                            Tidak ada pengeluaran pada periode ini.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Rincian Kategori - Pemasukan -->
            <div x-show="SelectedTransactionType === 'pemasukan'" x-transition x-cloak>
                <h3 class="font-bold text-gray-deep mb-4 text-lg">Rincian Kategori</h3>

                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    @forelse ($incomes as $inc)
                        <div class="p-4 border-b border-gray-100 last:border-0 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 {{ $inc['bg'] }} rounded-full flex items-center justify-center {{ $inc['text'] }}">
                                    <x-ui.icon name="{{ $inc['icon'] }}" class="w-5 h-5" />
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-deep">{{ $inc['nama'] }}</p>
                                    <p class="text-xs font-medium text-gray-light">{{ $inc['persen'] }}</p>
                                </div>
                            </div>
                            <p class="text-sm font-bold text-secondary">+ Rp {{ $inc['nominal_formatted'] }}</p>
                        </div>
                    @empty
                        <div class="p-6 text-center text-sm text-gray-medium">
                            Tidak ada pemasukan pada periode ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
