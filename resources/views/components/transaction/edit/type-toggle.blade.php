<div class="flex bg-toggle-bg border border-gray-200 p-1.5 rounded-xl mb-8">
    <button type="button" @click="SelectedTransactionType = 'pengeluaran'"
        :class="SelectedTransactionType === 'pengeluaran' ? 'bg-white shadow-sm text-primary' :
            'text-gray-medium hover:text-gray-deep'"
        class="flex-1 py-3 text-sm font-bold rounded-lg transition cursor-pointer">Pengeluaran</button>
    <button type="button" @click="SelectedTransactionType = 'pemasukan'"
        :class="SelectedTransactionType === 'pemasukan' ? 'bg-white shadow-sm text-primary' :
            'text-gray-medium hover:text-gray-deep'"
        class="flex-1 py-3 text-sm font-bold rounded-lg transition cursor-pointer">Pemasukan</button>
</div>
