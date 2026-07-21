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

    <div class="px-6 py-5 bg-background sticky top-0 z-20">
        <h2 class="text-2xl font-bold text-gray-deep mb-6">Laporan</h2>

        <x-ui.month-selector />

        <!-- Period Tabs -->
        <div class="flex bg-gray-200/60 p-1 rounded-xl mb-4">
            <button
                class="flex-1 py-1.5 text-sm font-semibold text-gray-light hover:text-gray-deep transition">Harian</button>
            <button
                class="flex-1 py-1.5 text-sm font-semibold text-gray-light hover:text-gray-deep transition">Mingguan</button>
            <button
                class="flex-1 py-1.5 text-sm font-semibold bg-white text-gray-deep shadow-sm rounded-lg transition">Bulanan</button>
        </div>

        <!-- Type Tabs -->
        <div class="flex gap-4 border-b border-gray-200 mb-6 px-2">
            <button class="pb-3 text-sm font-bold text-gray-light">Pemasukan</button>
            <button class="pb-3 text-sm font-bold text-primary border-b-2 border-primary">Pengeluaran</button>
        </div>
    </div>

    <div class="px-6 pb-24">
        <!-- Donut Chart Area -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-200 mb-8 flex justify-center relative">
            <div class="relative w-48 h-48">
                <!-- SVG Donut Chart representation -->
                <x-ui.icon name="donut-chart" class="w-full h-full transform -rotate-90" />

                <!-- Inner Text -->
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <p class="text-xs font-bold text-gray-light uppercase tracking-wide">Total</p>
                    <p class="text-xl font-bold text-gray-deep mt-1">12.400.000</p>
                </div>
            </div>
        </div>

        <!-- Rincian Kategori -->
        <div>
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
                        <p class="text-sm font-bold text-gray-deep">- Rp {{ $cat['nominal'] }}</p>
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
                    <p class="text-sm font-bold text-gray-deep">- Rp 1.240.000</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
