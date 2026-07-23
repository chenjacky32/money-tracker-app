@props(['latestTransactions'])

<div class="mb-6">
    <div class="flex justify-between items-center mb-4 px-1">
        <h3 class="font-bold text-gray-deep text-lg">Transaksi Terakhir</h3>
        <a href="{{ route('transactions.index') }}" class="text-sm text-info font-medium">Semua</a>
    </div>

    <div class="bg-background rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        @forelse ($latestTransactions as $trx)
            <a href="{{ route('transactions.edit', $trx['id']) }}">
                <x-transaction.card :nama="$trx['nama']" :kategori="$trx['kategori']" :nominal="$trx['nominal']" :tipe="$trx['tipe']"
                    :jam="$trx['jam']" :icon="$trx['icon'] ?? 'other'" />
            </a>
        @empty
            <div class="p-6 text-center text-sm text-gray-medium">
                Tidak ada transaksi pada periode ini.
            </div>
        @endforelse
    </div>
</div>
