@props(['nama', 'kategori', 'nominal', 'tipe', 'jam'])

<div class="bg-white rounded-2xl p-4 flex items-center justify-between border-b border-gray-100 last:border-0 hover:bg-gray-50 transition cursor-pointer">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $tipe === 'pemasukan' ? 'bg-secondary text-white' : 'bg-[#F2F4F3] text-gray-700' }}">
            @if($tipe === 'pemasukan')
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>
            @else
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>
            @endif
        </div>
        <div>
            <h4 class="font-semibold text-gray-900">{{ $nama }}</h4>
            <p class="text-[13px] text-gray-500 mt-0.5">{{ $jam }} &bull; {{ $kategori }}</p>
        </div>
    </div>
    <div class="text-right">
        <p class="font-medium text-[15px] tracking-tight {{ $tipe === 'pemasukan' ? 'text-primary' : 'text-danger' }}">
            {{ $tipe === 'pemasukan' ? '+Rp' : '- Rp' }} {{ number_format($nominal, 0, ',', '.') }}
        </p>
    </div>
</div>
