@props(['incomes', 'expenses'])

<div x-show="SelectedTransactionType === 'pengeluaran'" x-transition>
    <h3 class="font-bold text-gray-deep mb-4 text-lg">Rincian Kategori</h3>

    <div class="bg-background rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        @forelse ($expenses as $exp)
            <div class="p-4 border-b border-gray-200 last:border-0 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="w-10 h-10 {{ $exp['bg'] }} rounded-full border-1 flex items-center justify-center {{ $exp['text'] }}">
                        <x-ui.icon name="{{ $exp['icon'] }}" class="w-5 h-5 text-black" />
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

    <div class="bg-background rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
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
