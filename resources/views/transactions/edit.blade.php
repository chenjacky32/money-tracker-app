<x-guest-layout>
    <!-- Header -->
    <x-transaction.edit.header />

    <div class="px-6 pb-8 bg-background">
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="space-y-6"
            x-data="transactionForm" x-init="SelectedTransactionType = '{{ $transaction->transactionType->name }}';
            
            @if ($transaction->category && $transaction->category->user_id !== null) @php
                        $lainnya = $categories->where('transaction_type_id', $transaction->transaction_type_id)->filter(fn($c) => strtolower($c->name) === 'lainnya')->first();
                    @endphp
                    SelectedCategory = '{{ $lainnya->id ?? '' }}';
                @else
                    SelectedCategory = '{{ $transaction->category_id }}'; @endif
            
            transactionsAmount = {{ (int) $transaction->amount }};
            formattedAmount = '{{ number_format($transaction->amount, 0, ',', '.') }}';
            datePickerValue = '{{ $transaction->date->locale('id')->translatedFormat('d M Y') }}';
            
            const txDate = new Date('{{ $transaction->date->format('Y-m-d') }}');
            datePickerMonth = txDate.getMonth();
            datePickerYear = txDate.getFullYear();
            datePickerCalculateDays();
            
            SelectedCategoryName = '';
            setTimeout(() => {
                const el = document.querySelector('[data-category-id=\'' + SelectedCategory + '\']');
                SelectedCategoryName = el ? el.getAttribute('data-category-name') : '';
            }, 100);
            
            $watch('SelectedCategory', id => {
                const el = document.querySelector('[data-category-id=\'' + id + '\']');
                SelectedCategoryName = el ? el.getAttribute('data-category-name') : '';
            });
            $watch('SelectedTransactionType', value => {
                SelectedCategory = '';
                SelectedCategoryName = '';
            });" @submit="submitForm($event)">
            @csrf
            @method('PUT')
            <input type="hidden" name="transaction_type" :value="SelectedTransactionType">
            <input type="hidden" name="category_id" :value="SelectedCategory">
            <input type="hidden" name="amount" :value="transactionsAmount">
            <input type="hidden" name="date" :value="datePickerValue">

            <!-- Tipe Transaksi Toggle -->
            <x-transaction.edit.type-toggle />

            <!-- Nominal Input -->
            <x-transaction.edit.amount-input />

            <!-- Kategori Grid -->
            <x-transaction.edit.category-grid :categories="$categories" :transaction="$transaction" />

            <!-- Tanggal Input -->
            <x-transaction.edit.date-input />

            <!-- Catatan Input -->
            <x-transaction.edit.note-input :transaction="$transaction" />

            <!-- Submit Button -->
            <x-transaction.edit.submit-button />
        </form>
        <form id="delete-transaction-form" action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
            class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</x-guest-layout>
