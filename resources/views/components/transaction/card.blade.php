@props(['nama', 'kategori', 'nominal', 'tipe', 'jam'])

<div
    class="bg-white rounded-2xl p-4 flex items-center justify-between 
            border-b border-gray-100 last:border-0 
            hover:bg-gray-50 transition cursor-pointer">
    <div class="flex items-center gap-4">
        <div
            class="w-12 h-12 rounded-2xl flex items-center justify-center 
                {{ $tipe === 'pemasukan' ? 'bg-secondary text-white' : 'bg-muted text-gray-dark' }}">
            @if ($tipe === 'pemasukan')
                <x-ui.icon name="wallet-solid" class="w-6 h-6" />
            @else
                <x-ui.icon name="food" class="w-6 h-6" />
            @endif
        </div>
        <div class="text-start">
            <h4 class="font-semibold text-gray-deep">{{ $nama }}</h4>
            <p class="text-sm text-gray-light mt-0.5">{{ $jam }} &bull; {{ $kategori }}</p>
        </div>
    </div>
    <div class="text-right">
        <p class="font-medium text-base tracking-tight {{ $tipe === 'pemasukan' ? 'text-primary' : 'text-danger' }}">
            {{ $tipe === 'pemasukan' ? '+Rp' : '- Rp' }} {{ number_format($nominal, 0, ',', '.') }}
        </p>
    </div>
</div>
