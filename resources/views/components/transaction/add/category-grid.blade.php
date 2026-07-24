@props(['categories'])

<div>
    <label class="block text-sm font-bold text-gray-darker mb-4 tracking-wide">KATEGORI</label>
    <div class="grid grid-cols-4 gap-3">
        @foreach ($categories as $cat)
            <button type="button" x-show="SelectedTransactionType === '{{ $cat->transactionType->name }}'"
                @click="SelectedCategory = '{{ $cat->id }}'" data-category-id="{{ $cat->id }}"
                data-category-name="{{ strtolower($cat->name) }}"
                :class="SelectedCategory === '{{ $cat->id }}' ? 'bg-secondary text-white border-secondary' :
                    'bg-muted text-gray-light border-gray-200 hover:bg-gray-50'"
                class="cursor-pointer flex flex-col items-center py-4 rounded-[20px] shadow-sm transition border">

                <div x-show="SelectedCategory === '{{ $cat->id }}'">
                    <x-ui.icon name="{{ $cat->icon ?? 'other' }}" class="w-8 h-8 mb-2" />
                </div>

                <div x-show="SelectedCategory !== '{{ $cat->id }}'">
                    <div class="w-8 h-8 mb-2 bg-muted rounded-full flex items-center justify-center">
                        <x-ui.icon name="{{ $cat->icon ?? 'other' }}" class="w-4 h-4 text-gray-medium" />
                    </div>
                </div>

                <span class="text-sm font-medium"
                    :class="SelectedCategory === '{{ $cat->id }}' ? '' : 'text-gray-medium'">{{ $cat->name }}</span>
            </button>
        @endforeach
    </div>

    <!-- Input Kategori Lainnya (hanya muncul saat kategori 'Lainnya' dipilih) -->
    <div x-show="SelectedCategoryName === 'lainnya'" x-transition x-cloak
        class="bg-white dark:bg-muted rounded-[20px] border border-gray-soft p-4 mt-4 shadow-sm flex items-center gap-4">
        <div class="w-10 h-10 bg-muted rounded-full flex items-center justify-center text-gray-medium shrink-0">
            <x-ui.icon name="document-text" class="w-5 h-5" />
        </div>
        <div class="w-full">
            <p class="text-xs font-bold text-gray-darker tracking-wide mb-0.5">NAMA KATEGORI LAINNYA</p>
            <input type="text" name="custom_category_name"
                class="w-full border-none p-0 text-base focus:ring-0 bg-transparent placeholder-gray-light"
                placeholder="Masukkan nama kategori lainnya...">
        </div>
    </div>
</div>
