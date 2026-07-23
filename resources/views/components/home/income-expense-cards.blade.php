@props(['pemasukan', 'pengeluaran', 'label1', 'label2'])

<div class="flex gap-4 mb-6">
    <div class="flex-1 bg-white rounded-2xl p-4 shadow-sm border border-gray-200">
        <div class="flex items-center gap-2 mb-3">
            <div class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center text-white">
                <x-ui.icon name="arrow-down-long" class="w-4 h-4" />
            </div>
            <p class="text-xs font-bold text-gray-darker uppercase tracking-wide">Pemasukan</p>
        </div>
        <p class="font-bold text-primary text-sm tracking-tight">+ Rp {{ number_format($pemasukan, 0, ',', '.') }}</p>
    </div>
    <div class="flex-1 bg-white rounded-2xl p-4 shadow-sm border border-gray-200">
        <div class="flex items-center gap-2 mb-3">
            <div class="w-8 h-8 rounded-full bg-danger-light flex items-center justify-center text-danger">
                <x-ui.icon name="arrow-up-long" class="w-4 h-4" />
            </div>
            <p class="text-xs font-bold text-gray-darker uppercase tracking-wide">Pengeluaran</p>
        </div>
        <p class="font-bold text-danger text-sm tracking-tight">- Rp {{ number_format($pengeluaran, 0, ',', '.') }}</p>
    </div>
</div>
