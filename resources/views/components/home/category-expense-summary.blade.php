@props(['expenses', 'selectedMonthYear'])

<div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-200 mb-6">
    <div class="flex justify-between items-end mb-4">
        <h3 class="font-bold text-gray-deep leading-tight max-w-[200px]">Pengeluaran<br>Berdasarkan Kategori</h3>
        <a href="{{ route('reports', ['period_type' => 'bulanan', 'month_year' => $selectedMonthYear]) }}"
            class="text-xs text-info font-medium text-right leading-tight">Lihat<br>Semua</a>
    </div>

    <div class="space-y-4">
        @forelse ($expenses as $exp)
            <div>
                <div class="flex justify-between items-end mb-1.5">
                    <span class="text-sm text-gray-medium">{{ $exp['kategori'] }}</span>
                    <span class="text-sm font-bold text-gray-deep">Rp {{ $exp['nominal'] }}</span>
                </div>
                <div x-data="{
                    progress: 0,
                    progressInterval: null,
                    target: {{ $exp['percent'] }}
                }" x-init="progressInterval = setInterval(() => {
                    if (progress >= target) {
                        progress = target;
                        clearInterval(progressInterval);
                    } else {
                        progress = progress + 1;
                    }
                }, 15);"
                    class="relative w-full h-2 overflow-hidden rounded-full bg-gray-200">
                    <span :style="'width:' + progress + '%'"
                        class="absolute h-full duration-300 ease-linear bg-danger" x-cloak></span>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-medium text-center py-2">Belum ada pengeluaran pada periode ini.</p>
        @endforelse
    </div>
</div>
