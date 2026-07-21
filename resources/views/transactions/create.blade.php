<x-guest-layout>
    <!-- Header -->
    <div class="px-6 py-5 bg-background flex items-center gap-6 sticky top-0 z-40">
        <a href="javascript:history.back()" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-darker hover:bg-gray-50 shadow-sm transition">
            <x-ui.icon name="x-mark" class="w-5 h-5" />
        </a>
        <h2 class="text-2xl font-bold text-gray-deep">Tambah Transaksi</h2>
    </div>

    <div class="px-6 pb-8 bg-background">
        <form class="space-y-6">
            
            <!-- Tipe Transaksi Toggle -->
            <div class="flex bg-toggle-bg border border-gray-200 p-1.5 rounded-xl mb-8">
                <button type="button" class="flex-1 py-3 text-sm font-bold rounded-lg bg-white shadow-sm text-primary transition">Pengeluaran</button>
                <button type="button" class="flex-1 py-3 text-sm font-bold rounded-lg text-gray-medium hover:text-gray-deep transition">Pemasukan</button>
            </div>

            <!-- Nominal Input -->
            <div class="text-center mb-8">
                <label class="block text-sm font-bold text-gray-darker mb-2 tracking-wide">JUMLAH</label>
                <div class="flex items-center justify-center gap-2 border-b border-gray-300 pb-2 mx-8">
                    <span class="text-xl font-medium text-gray-medium">Rp</span>
                    <input type="number" class="w-32 text-center bg-transparent border-none text-4xl font-bold text-primary p-0 focus:ring-0" placeholder="0" value="0">
                </div>
            </div>

            @php
                $categories = [
                    ['id' => 'food', 'label' => 'Makan', 'icon' => 'food', 'active' => true],
                    ['id' => 'shopping', 'label' => 'Belanja', 'icon' => 'shopping', 'active' => false],
                    ['id' => 'transport', 'label' => 'Transport', 'icon' => 'transport', 'active' => false],
                    ['id' => 'bills', 'label' => 'Tagihan', 'icon' => 'bills', 'active' => false],
                    ['id' => 'entertainment', 'label' => 'Hiburan', 'icon' => 'entertainment', 'active' => false],
                    ['id' => 'health', 'label' => 'Sehat', 'icon' => 'health', 'active' => false],
                    ['id' => 'education', 'label' => 'Edukasi', 'icon' => 'education', 'active' => false],
                    ['id' => 'other', 'label' => 'Lainnya', 'icon' => 'other', 'active' => false],
                ];
            @endphp

            <!-- Kategori Grid -->
            <div>
                <label class="block text-sm font-bold text-gray-darker mb-4 tracking-wide">KATEGORI</label>
                <div class="grid grid-cols-4 gap-3">
                    @foreach($categories as $cat)
                        @if($cat['active'])
                            <button type="button" class="flex flex-col items-center py-4 bg-secondary text-white rounded-[20px] shadow-sm transition border border-secondary">
                                <x-ui.icon name="{{ $cat['icon'] }}" class="w-8 h-8 mb-2" />
                                <span class="text-sm font-medium">{{ $cat['label'] }}</span>
                            </button>
                        @else
                            <button type="button" class="flex flex-col items-center py-4 bg-white text-gray-light rounded-[20px] border border-gray-200 hover:bg-gray-50 transition">
                                <div class="w-8 h-8 mb-2 bg-muted rounded-full flex items-center justify-center">
                                    <x-ui.icon name="{{ $cat['icon'] }}" class="w-4 h-4 text-gray-medium" />
                                </div>
                                <span class="text-sm font-medium text-gray-medium">{{ $cat['label'] }}</span>
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Tanggal Input -->
            <div class="bg-white rounded-[20px] border border-gray-200 p-4 mt-6 shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-muted rounded-full flex items-center justify-center text-gray-medium">
                        <x-ui.icon name="calendar" class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-darker tracking-wide mb-0.5">TANGGAL</p>
                        <p class="text-base text-gray-deep">Hari Ini, 24 Okt 2023</p>
                    </div>
                </div>
                <x-ui.icon name="chevron-right" class="w-5 h-5 text-gray-muted" />
            </div>

            <!-- Catatan Input -->
            <div class="bg-white rounded-[20px] border border-gray-200 p-4 mt-4 shadow-sm flex items-center gap-4">
                <div class="w-10 h-10 bg-muted rounded-full flex items-center justify-center text-gray-medium shrink-0">
                    <x-ui.icon name="document-text" class="w-5 h-5" />
                </div>
                <div class="w-full">
                    <p class="text-xs font-bold text-gray-darker tracking-wide mb-0.5">CATATAN</p>
                    <input type="text" class="w-full border-none p-0 text-base focus:ring-0 bg-transparent placeholder-gray-light" placeholder="Tambahkan deskripsi opsional...">
                </div>
            </div>

            <div class="pt-8 pb-12">
                <button type="button" class="w-full bg-primary text-white rounded-[20px] py-4 text-base font-bold shadow-md hover:bg-primary/90 transition flex items-center justify-center gap-2">
                    <x-ui.icon name="check" class="w-5 h-5" />
                    Simpan Transaksi
                </button>
            </div>
            
        </form>
    </div>
</x-guest-layout>
