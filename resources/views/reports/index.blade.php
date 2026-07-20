<x-app-layout>
    <div class="px-6 py-5 bg-[#F8FAFC] sticky top-0 z-40">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Laporan</h2>
        
        <x-ui.month-selector />

        <!-- Period Tabs -->
        <div class="flex bg-[#F2F4F3] border border-gray-200 p-1 rounded-full mb-4">
            <button class="flex-1 py-2 text-[13px] font-medium rounded-full text-gray-500 hover:text-gray-900 transition">Harian</button>
            <button class="flex-1 py-2 text-[13px] font-medium rounded-full text-gray-500 hover:text-gray-900 transition">Mingguan</button>
            <button class="flex-1 py-2 text-[13px] font-bold rounded-full bg-white shadow-sm text-primary transition">Bulanan</button>
        </div>

        <!-- Type Tabs -->
        <div class="flex bg-[#E9EBEA] border border-gray-200 p-1 rounded-xl mb-2">
            <button class="flex-1 py-2.5 text-[14px] font-medium rounded-lg text-gray-600 hover:text-gray-900 transition">Pemasukan</button>
            <button class="flex-1 py-2.5 text-[14px] font-bold rounded-lg bg-white shadow-sm text-gray-900 transition">Pengeluaran</button>
        </div>
    </div>

    <div class="px-6 pb-6">
        <!-- Chart Card -->
        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-200 mb-6 flex flex-col items-center">
            <h3 class="font-bold text-gray-900 text-lg mb-6 self-start">Distribusi Pengeluaran</h3>
            
            <div class="relative w-56 h-56 flex items-center justify-center mb-4">
                <!-- SVG Donut Chart -->
                <svg viewBox="0 0 36 36" class="w-full h-full transform -rotate-90">
                    <path class="text-[#F2F4F3]" stroke-dasharray="100, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="6"></path>
                    <path class="text-primary" stroke-dasharray="45, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="6"></path>
                </svg>
                <div class="absolute flex flex-col items-center justify-center mt-2">
                    <span class="text-[11px] font-bold text-gray-900 mb-0.5">Total</span>
                    <span class="text-xl font-bold text-gray-900 tracking-tight">Rp 12.4M</span>
                </div>
            </div>
        </div>

        <!-- Rincian Kategori -->
        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-200">
            <h3 class="font-bold text-gray-900 text-lg mb-4">Rincian Kategori</h3>
            
            <div class="space-y-4">
                <!-- Item 1 -->
                <div class="flex items-center justify-between border-b border-gray-50 pb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#D1E6E2] text-primary flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-[15px] text-gray-900 leading-tight">Tempat<br>Tinggal</h4>
                            <p class="text-[12px] text-gray-500 mt-1">40%</p>
                        </div>
                    </div>
                    <span class="font-medium text-[15px] text-gray-900 tracking-tight">Rp 4.960.000</span>
                </div>
                
                <!-- Item 2 -->
                <div class="flex items-center justify-between border-b border-gray-50 pb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-[15px] text-gray-900 leading-tight">Makanan</h4>
                            <p class="text-[12px] text-gray-500 mt-1">20%</p>
                        </div>
                    </div>
                    <span class="font-medium text-[15px] text-gray-900 tracking-tight">Rp 2.480.000</span>
                </div>
                
                <!-- Item 3 -->
                <div class="flex items-center justify-between border-b border-gray-50 pb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-[15px] text-gray-900 leading-tight">Transportasi</h4>
                            <p class="text-[12px] text-gray-500 mt-1">15%</p>
                        </div>
                    </div>
                    <span class="font-medium text-[15px] text-gray-900 tracking-tight">Rp 1.860.000</span>
                </div>
                
                <!-- Item 4 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#E5D5C5] text-amber-800 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-[15px] text-gray-900 leading-tight">Belanja</h4>
                            <p class="text-[12px] text-gray-500 mt-1">15%</p>
                        </div>
                    </div>
                    <span class="font-medium text-[15px] text-gray-900 tracking-tight">Rp 1.860.000</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
