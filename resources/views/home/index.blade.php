<x-app-layout>
    <div class="px-5 pt-6 pb-2">
        <x-ui.month-selector :selectedMonthYear="$selectedMonthYear" />

        <!-- Total Saldo -->
        <x-home.total-balance :total="$summary['total']" label="Total Saldo" />

        <!-- Pemasukan & Pengeluaran -->
        <x-home.income-expense-cards :pemasukan="$summary['pemasukan']" :pengeluaran="$summary['pengeluaran']" />

        <!-- Ringkasan Pemasukan -->
        <x-home.category-income-summary :incomes="$incomes" :selectedMonthYear="$selectedMonthYear" />

        <!-- Ringkasan Pengeluaran -->
        <x-home.category-expense-summary :expenses="$expenses" :selectedMonthYear="$selectedMonthYear" />

        <!-- Transaksi Terakhir -->
        <x-home.latest-transactions :latestTransactions="$latestTransactions" />
    </div>
</x-app-layout>
