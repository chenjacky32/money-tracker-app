<x-guest-layout>
    <!-- Header -->
    <div class="px-6 py-5 bg-background flex items-center gap-6 sticky top-0 z-40">
        <a href="{{ route('history') }}"
            class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-darker hover:bg-gray-50 shadow-sm transition">
            <x-ui.icon name="x-mark" class="w-5 h-5" />
        </a>
        <h2 class="text-2xl font-bold text-gray-deep">Tambah Transaksi</h2>
    </div>

    <div class="px-6 pb-8 bg-background">
        <form class="space-y-6" x-data="transactionForm">

            <!-- Tipe Transaksi Toggle -->
            <div class="flex bg-toggle-bg border border-gray-200 p-1.5 rounded-xl mb-8">
                <button type="button" @click="SelectedTransactionType = 'pengeluaran'"
                    :class="SelectedTransactionType === 'pengeluaran' ? 'bg-white shadow-sm text-primary' :
                        'text-gray-medium hover:text-gray-deep'"
                    class="flex-1 py-3 text-sm font-bold rounded-lg transition cursor-pointer">Pengeluaran</button>
                <button type="button" @click="SelectedTransactionType = 'pemasukan'"
                    :class="SelectedTransactionType === 'pemasukan' ? 'bg-white shadow-sm text-primary' :
                        'text-gray-medium hover:text-gray-deep'"
                    class="flex-1 py-3 text-sm font-bold rounded-lg transition cursor-pointer">Pemasukan</button>
            </div>

            <!-- Nominal Input -->
            <div class="text-center mb-8 relative">
                <label class="block text-sm font-bold text-gray-darker mb-2 tracking-wide">JUMLAH</label>
                <div class="flex items-center justify-center gap-2 border-b border-gray-300 pb-2 mx-8">
                    <span class="text-xl font-medium text-gray-medium">Rp</span>
                    <input type="text" @input="formatAmount($event)" :value="formattedAmount"
                        class="w-full text-center bg-transparent border-none text-4xl font-bold text-primary p-0 focus:ring-0"
                        placeholder="0">
                </div>
                <p x-show="amountError" class="text-danger text-xs mt-2" x-cloak>Jumlah harus diisi dan tidak boleh
                    kosong dan minus</p>
            </div>

            @php
                $categories = [
                    ['id' => '1', 'label' => 'Makan', 'icon' => 'food'],
                    ['id' => '2', 'label' => 'Belanja', 'icon' => 'shopping'],
                    ['id' => '3', 'label' => 'Transport', 'icon' => 'transport'],
                    ['id' => '4', 'label' => 'Tagihan', 'icon' => 'bills'],
                    ['id' => '5', 'label' => 'Hiburan', 'icon' => 'entertainment'],
                    ['id' => '6', 'label' => 'Sehat', 'icon' => 'health'],
                    ['id' => '7', 'label' => 'Edukasi', 'icon' => 'education'],
                    ['id' => '8', 'label' => 'Lainnya', 'icon' => 'other'],
                ];
            @endphp

            <!-- Kategori Grid -->
            <div>
                <label class="block text-sm font-bold text-gray-darker mb-4 tracking-wide">KATEGORI</label>
                <div class="grid grid-cols-4 gap-3">
                    @foreach ($categories as $cat)
                        <button type="button" @click="SelectedCategory = '{{ $cat['id'] }}'"
                            :class="SelectedCategory === '{{ $cat['id'] }}' ? 'bg-secondary text-white border-secondary' :
                                'bg-white text-gray-light border-gray-200 hover:bg-gray-50'"
                            class="flex flex-col items-center py-4 rounded-[20px] shadow-sm transition border">

                            <div x-show="SelectedCategory === '{{ $cat['id'] }}'">
                                <x-ui.icon name="{{ $cat['icon'] }}" class="w-8 h-8 mb-2" />
                            </div>

                            <div x-show="SelectedCategory !== '{{ $cat['id'] }}'">
                                <div class="w-8 h-8 mb-2 bg-muted rounded-full flex items-center justify-center">
                                    <x-ui.icon name="{{ $cat['icon'] }}" class="w-4 h-4 text-gray-medium" />
                                </div>
                            </div>

                            <span class="text-sm font-medium"
                                :class="SelectedCategory === '{{ $cat['id'] }}' ? '' : 'text-gray-medium'">{{ $cat['label'] }}</span>
                        </button>
                    @endforeach
                </div>

                <!-- Input Kategori Lainnya (hanya muncul saat kategori 'Lainnya' dipilih) -->
                <div x-show="SelectedCategory === '8'" x-transition x-cloak
                    class="bg-white rounded-[20px] border border-gray-200 p-4 mt-4 shadow-sm flex items-center gap-4">
                    <div
                        class="w-10 h-10 bg-muted rounded-full flex items-center justify-center text-gray-medium shrink-0">
                        <x-ui.icon name="document-text" class="w-5 h-5" />
                    </div>
                    <div class="w-full">
                        <p class="text-xs font-bold text-gray-darker tracking-wide mb-0.5">NAMA KATEGORI LAINNYA</p>
                        <input type="text"
                            class="w-full border-none p-0 text-base focus:ring-0 bg-transparent placeholder-gray-light"
                            placeholder="Masukkan nama kategori lainnya...">
                    </div>
                </div>
            </div>

            <!-- Tanggal Input -->
            <div class="relative mt-6">
                <div @click="datePickerOpen = !datePickerOpen"
                    class="bg-white rounded-[20px] border border-gray-200 p-4 shadow-sm flex items-center justify-between cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-muted rounded-full flex items-center justify-center text-gray-medium">
                            <x-ui.icon name="calendar" class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-darker tracking-wide mb-0.5">TANGGAL</p>
                            <p class="text-base text-gray-deep" x-text="datePickerValue"></p>
                        </div>
                    </div>
                    <x-ui.icon name="chevron-right" class="w-5 h-5 text-gray-muted" />
                </div>

                <!-- Datepicker Modal -->
                <div x-show="datePickerOpen" @click.away="datePickerOpen = false" x-transition x-cloak
                    class="absolute top-full left-0 mt-2 w-full max-w-sm bg-white border border-gray-200 rounded-xl shadow-lg p-4 z-50">
                    <div class="flex justify-between items-center mb-4">
                        <button @click.prevent="datePickerPreviousMonth()" type="button"
                            class="p-1 hover:bg-gray-100 rounded-full transition">
                            <x-ui.icon name="chevron-left" class="w-5 h-5" />
                        </button>
                        <div class="font-bold text-gray-deep"
                            x-text="datePickerMonthNames[datePickerMonth] + ' ' + datePickerYear"></div>
                        <button @click.prevent="datePickerNextMonth()" type="button"
                            class="p-1 hover:bg-gray-100 rounded-full transition">
                            <x-ui.icon name="chevron-right-thick" class="w-5 h-5" />
                        </button>
                    </div>
                    <div class="grid grid-cols-7 mb-2">
                        <template x-for="day in datePickerDays" :key="day">
                            <div class="text-center text-xs font-medium text-gray-medium" x-text="day"></div>
                        </template>
                    </div>
                    <div class="grid grid-cols-7 gap-1">
                        <template x-for="blankDay in datePickerBlankDaysInMonth">
                            <div class="p-1 text-sm text-center border border-transparent"></div>
                        </template>
                        <template x-for="day in datePickerDaysInMonth" :key="day">
                            <button @click.prevent="datePickerDayClicked(day)" type="button"
                                :class="{
                                    'bg-primary text-white': datePickerIsSelectedDate(day),
                                    'text-gray-900 hover:bg-gray-100': !datePickerIsSelectedDate(day)
                                }"
                                class="w-8 h-8 mx-auto flex justify-center items-center rounded-full text-sm transition"
                                x-text="day"></button>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Catatan Input -->
            <div class="bg-white rounded-[20px] border border-gray-200 p-4 mt-4 shadow-sm flex items-center gap-4">
                <div class="w-10 h-10 bg-muted rounded-full flex items-center justify-center text-gray-medium shrink-0">
                    <x-ui.icon name="document-text" class="w-5 h-5" />
                </div>
                <div class="w-full">
                    <p class="text-xs font-bold text-gray-darker tracking-wide mb-0.5">CATATAN</p>
                    <input type="text"
                        class="w-full border-none p-0 text-base focus:ring-0 bg-transparent placeholder-gray-light"
                        placeholder="Tambahkan deskripsi opsional...">
                </div>
            </div>

            <div class="pt-8 pb-12">
                <button type="button" @click="submitForm('create')" :disabled="isSubmitting"
                    class="w-full bg-primary text-white rounded-[20px] py-4 text-base font-bold shadow-md hover:bg-primary/90 transition flex items-center justify-center gap-2 disabled:opacity-75 disabled:cursor-wait">
                    <x-ui.icon name="check" class="w-5 h-5" x-show="!isSubmitting" />
                    <span x-text="isSubmitting ? 'Loading...' : 'Simpan Transaksi'"></span>
                </button>
            </div>

        </form>
    </div>
</x-guest-layout>
