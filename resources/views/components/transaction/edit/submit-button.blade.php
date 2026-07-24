<div class="pt-8 pb-12 flex gap-4">
    <button type="button"
        @click="
            window.Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-transaction-form').submit();
                }
            });
        "
        class="cursor-pointer w-16 bg-white dark:bg-muted border border-gray-soft text-danger rounded-[20px] flex items-center justify-center shadow-sm hover:bg-gray-soft transition">
        <x-ui.icon name="trash" class="w-6 h-6" />
    </button>
    <button type="submit"
        class="cursor-pointer flex-1 bg-primary text-white rounded-[20px] py-4 text-base font-bold shadow-md hover:bg-primary/90 transition flex items-center justify-center gap-2 disabled:opacity-75 disabled:cursor-wait">
        <x-ui.icon name="check" class="w-5 h-5" />
        <span>Simpan Perubahan</span>
    </button>
</div>
