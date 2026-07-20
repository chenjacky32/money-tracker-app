<x-guest-layout>
    <!-- Header -->
    <div class="px-6 py-5 bg-[#F8FAFC] flex items-center gap-6 sticky top-0 z-40">
        <a href="javascript:history.back()" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-800 hover:bg-gray-50 shadow-sm transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>
        <h2 class="text-[22px] font-bold text-gray-900">Tambah Transaksi</h2>
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
                    <input type="number" class="w-32 text-center bg-transparent border-none text-[40px] font-bold text-primary p-0 focus:ring-0" placeholder="0" value="0">
                </div>
            </div>

            <!-- Kategori Grid -->
            <div>
                <label class="block text-[13px] font-bold text-gray-800 mb-4 tracking-wide">KATEGORI</label>
                <div class="grid grid-cols-4 gap-3">
                    <!-- Active Item -->
                    <button type="button" class="flex flex-col items-center py-4 bg-secondary text-white rounded-[20px] shadow-sm transition border border-secondary">
                        <svg class="w-8 h-8 mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>
                        <span class="text-[13px] font-medium">Makan</span>
                    </button>
                    
                    <!-- Inactive Items -->
                    <button type="button" class="flex flex-col items-center py-4 bg-white text-gray-500 rounded-[20px] border border-gray-200 hover:bg-gray-50 transition">
                        <div class="w-8 h-8 mb-2 bg-[#F2F4F3] rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <span class="text-[13px] font-medium text-gray-600">Belanja</span>
                    </button>
                    
                    <button type="button" class="flex flex-col items-center py-4 bg-white text-gray-500 rounded-[20px] border border-gray-200 hover:bg-gray-50 transition">
                        <div class="w-8 h-8 mb-2 bg-[#F2F4F3] rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-[13px] font-medium text-gray-600">Transport</span>
                    </button>
                    
                    <button type="button" class="flex flex-col items-center py-4 bg-white text-gray-500 rounded-[20px] border border-gray-200 hover:bg-gray-50 transition">
                        <div class="w-8 h-8 mb-2 bg-[#F2F4F3] rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="text-[13px] font-medium text-gray-600">Tagihan</span>
                    </button>
                    
                    <button type="button" class="flex flex-col items-center py-4 bg-white text-gray-500 rounded-[20px] border border-gray-200 hover:bg-gray-50 transition">
                        <div class="w-8 h-8 mb-2 bg-[#F2F4F3] rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg>
                        </div>
                        <span class="text-[13px] font-medium text-gray-600">Hiburan</span>
                    </button>
                    
                    <button type="button" class="flex flex-col items-center py-4 bg-white text-gray-500 rounded-[20px] border border-gray-200 hover:bg-gray-50 transition">
                        <div class="w-8 h-8 mb-2 bg-[#F2F4F3] rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <span class="text-[13px] font-medium text-gray-600">Sehat</span>
                    </button>
                    
                    <button type="button" class="flex flex-col items-center py-4 bg-white text-gray-500 rounded-[20px] border border-gray-200 hover:bg-gray-50 transition">
                        <div class="w-8 h-8 mb-2 bg-[#F2F4F3] rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                        </div>
                        <span class="text-[13px] font-medium text-gray-600">Edukasi</span>
                    </button>
                    
                    <button type="button" class="flex flex-col items-center py-4 bg-white text-gray-500 rounded-[20px] border border-gray-200 hover:bg-gray-50 transition">
                        <div class="w-8 h-8 mb-2 bg-[#F2F4F3] rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                        </div>
                        <span class="text-[13px] font-medium text-gray-600">Lainnya</span>
                    </button>
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
                        <p class="text-[15px] text-gray-900">Hari Ini, 24 Okt 2023</p>
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
                    <input type="text" class="w-full border-none p-0 text-[15px] focus:ring-0 bg-transparent placeholder-gray-500" placeholder="Tambahkan deskripsi opsional...">
                </div>
            </div>

            <div class="pt-8 pb-12">
                <button type="button" class="w-full bg-primary text-white rounded-[20px] py-4 text-[16px] font-bold shadow-md hover:bg-primary/90 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Transaksi
                </button>
            </div>
            
        </form>
    </div>
</x-guest-layout>
