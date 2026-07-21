<x-guest-layout>
    <!-- Header -->
    <div class="px-6 py-5 bg-[#F8FAFC] flex items-center gap-6 sticky top-0 z-40">
        <a href="javascript:history.back()" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-800 hover:bg-gray-50 shadow-sm transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>
        <h2 class="text-[22px] font-bold text-gray-900">Edit Transaksi</h2>
    </div>

    <div class="px-6 pb-8 bg-[#F8FAFC]">
        <form class="space-y-6">
            
            <!-- Tipe Transaksi Toggle -->
            <div class="flex bg-[#E9EBEA] border border-gray-200 p-1.5 rounded-xl mb-8">
                <button type="button" class="flex-1 py-3 text-[14px] font-bold rounded-lg bg-white shadow-sm text-primary transition">Pengeluaran</button>
                <button type="button" class="flex-1 py-3 text-[14px] font-bold rounded-lg text-gray-600 hover:text-gray-900 transition">Pemasukan</button>
            </div>

            <!-- Nominal Input -->
            <div class="text-center mb-8">
                <label class="block text-[13px] font-bold text-gray-800 mb-2 tracking-wide">JUMLAH</label>
                <div class="flex items-center justify-center gap-2 border-b border-gray-300 pb-2 mx-8">
                    <span class="text-xl font-medium text-gray-600">Rp</span>
                    <input type="number" class="w-40 text-center bg-transparent border-none text-[40px] font-bold text-primary p-0 focus:ring-0" placeholder="0" value="50000">
                </div>
            </div>

            @php
                $categories = [
                    ['id' => 'food', 'label' => 'Makan', 'icon' => 'food', 'active' => true],
                    ['id' => 'shopping', 'label' => 'Belanja', 'icon' => 'shopping', 'active' => false],
                    ['id' => 'transport', 'label' => 'Transport', 'icon' => 'transport', 'active' => false],
                    ['id' => 'bills', 'label' => 'Tagihan', 'icon' => 'bills', 'active' => false],
                ];
            @endphp

            <!-- Kategori Grid -->
            <div>
                <label class="block text-[13px] font-bold text-gray-800 mb-4 tracking-wide">KATEGORI</label>
                <div class="grid grid-cols-4 gap-3">
                    @foreach($categories as $cat)
                        @if($cat['active'])
                            <button type="button" class="flex flex-col items-center py-4 bg-secondary text-white rounded-[20px] shadow-sm transition border border-secondary">
                                <x-ui.icon name="{{ $cat['icon'] }}" class="w-8 h-8 mb-2" />
                                <span class="text-[13px] font-medium">{{ $cat['label'] }}</span>
                            </button>
                        @else
                            <button type="button" class="flex flex-col items-center py-4 bg-white text-gray-500 rounded-[20px] border border-gray-200 hover:bg-gray-50 transition">
                                <div class="w-8 h-8 mb-2 bg-[#F2F4F3] rounded-full flex items-center justify-center">
                                    <x-ui.icon name="{{ $cat['icon'] }}" class="w-4 h-4 text-gray-600" />
                                </div>
                                <span class="text-[13px] font-medium text-gray-600">{{ $cat['label'] }}</span>
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Tanggal Input -->
            <div class="bg-white rounded-[20px] border border-gray-200 p-4 mt-6 shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-[#F2F4F3] rounded-full flex items-center justify-center text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-gray-800 tracking-wide mb-0.5">TANGGAL</p>
                        <p class="text-[15px] text-gray-900">Senin, 16 Nov 2026</p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </div>

            <!-- Catatan Input -->
            <div class="bg-white rounded-[20px] border border-gray-200 p-4 mt-4 shadow-sm flex items-center gap-4">
                <div class="w-10 h-10 bg-[#F2F4F3] rounded-full flex items-center justify-center text-gray-600 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                </div>
                <div class="w-full">
                    <p class="text-[11px] font-bold text-gray-800 tracking-wide mb-0.5">CATATAN</p>
                    <input type="text" class="w-full border-none p-0 text-[15px] focus:ring-0 bg-transparent placeholder-gray-500" value="Makan Siang Klien">
                </div>
            </div>

            <div class="pt-8 pb-12 flex gap-4">
                <button type="button" class="w-16 bg-white border border-gray-200 text-danger rounded-[20px] flex items-center justify-center shadow-sm hover:bg-gray-50 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
                <button type="button" class="flex-1 bg-primary text-white rounded-[20px] py-4 text-[16px] font-bold shadow-md hover:bg-primary/90 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
            
        </form>
    </div>
</x-guest-layout>
