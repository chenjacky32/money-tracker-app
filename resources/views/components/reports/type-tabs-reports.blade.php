<div class="flex gap-4 border-b border-background mb-6 px-2">
    <button type="button" @click="SelectedTransactionType = 'pemasukan'"
        :class="SelectedTransactionType === 'pemasukan' ? 'text-secondary border-b-2 border-secondary font-bold' :
            'text-gray-deep border-b-2 border-transparent font-medium'"
        class="pb-3 text-sm transition cursor-pointer">Pemasukan</button>
    <button type="button" @click="SelectedTransactionType = 'pengeluaran'"
        :class="SelectedTransactionType === 'pengeluaran' ? 'text-secondary border-b-2 border-secondary font-bold' :
            'text-gray-deep border-b-2 border-transparent font-medium'"
        class="pb-3 text-sm transition cursor-pointer">Pengeluaran</button>
</div>
