<x-guest-layout>
    <!-- Header -->
    <x-transaction.add.header />

    <div class="px-6 pb-8 bg-background">
        <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6" x-data="transactionForm"
            x-init="SelectedCategoryName = '';
            $watch('SelectedCategory', id => {
                const el = document.querySelector('[data-category-id=\'' + id + '\']');
                SelectedCategoryName = el ? el.getAttribute('data-category-name') : '';
            });
            $watch('SelectedTransactionType', value => {
                SelectedCategory = '';
                SelectedCategoryName = '';
            });" @submit="submitForm($event)">
            @csrf
            <input type="hidden" name="transaction_type" :value="SelectedTransactionType">
            <input type="hidden" name="category_id" :value="SelectedCategory">
            <input type="hidden" name="amount" :value="transactionsAmount">
            <input type="hidden" name="date" :value="datePickerValue">

            <!-- Tipe Transaksi Toggle -->
            <x-transaction.add.type-toggle />

            <!-- Nominal Input -->
            <x-transaction.add.amount-input />

            <!-- Kategori Grid -->
            <x-transaction.add.category-grid :categories="$categories" />

            <!-- Tanggal Input -->
            <x-transaction.add.date-input />

            <!-- Catatan Input -->
            <x-transaction.add.note-input />

            <!-- Submit Button -->
            <x-transaction.add.submit-button />

        </form>
    </div>
</x-guest-layout>
