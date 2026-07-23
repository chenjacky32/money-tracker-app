@props(['date', 'totalFormatted', 'group'])

<div>
    <div class="flex justify-between items-end mb-3 mx-2">
        <h3 class="text-sm font-medium text-gray-dark">{{ $date }}</h3>
        <span class="text-sm font-medium text-gray-deep">{{ $totalFormatted }}</span>
    </div>
    <div class="bg-background rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        @foreach ($group as $item)
            <button type="button" class="w-full"
                onclick="window.location.href='{{ route('transactions.edit', $item->id) }}'">
                <x-transaction.card :nama="$item->note ?? ($item->category->name ?? 'Transaksi')" :kategori="$item->category->name ?? 'Lainnya'" :nominal="$item->amount" :tipe="$item->transactionType->name"
                    :jam="$item->created_at->format('H.i')" :icon="$item->category->icon ?? 'other'" />
            </button>
        @endforeach
    </div>
</div>
