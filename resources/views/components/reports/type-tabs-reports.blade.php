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
