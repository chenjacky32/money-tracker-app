<div
    class="bg-background dark:bg-muted rounded-[20px] border border-gray-soft p-4 mt-4 shadow-sm flex items-center gap-4">
    <div class="w-10 h-10 bg-muted rounded-full flex items-center justify-center text-gray-medium shrink-0">
        <x-ui.icon name="document-text" class="w-5 h-5" />
    </div>
    <div class="w-full">
        <p class="text-xs font-bold text-gray-darker tracking-wide mb-0.5">CATATAN</p>
        <div class="w-full max-w-xs mx-auto">
            <textarea name="note" x-data="{
                resize() {
                    $el.style.height = '0px';
                    $el.style.height = $el.scrollHeight + 'px'
                }
            }" x-init="resize()" @input="resize()" type="text"
                placeholder="Tambahkan deskripsi opsional..."
                class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm text-gray-darker bg-transparent border rounded-md border-gray-soft ring-offset-background placeholder-gray-muted focus:border-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/20 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
        </div>
    </div>
</div>
