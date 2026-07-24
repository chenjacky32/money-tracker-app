<div class="text-center mb-8 relative">
    <label class="block text-sm font-bold text-gray-darker mb-2 tracking-wide">JUMLAH</label>
    <div class="flex items-center justify-center gap-2 border-b border-gray-soft pb-2 mx-8">
        <span class="text-xl font-medium text-gray-medium">Rp</span>
        <input type="text" @input="formatAmount($event)" :value="formattedAmount"
            class="w-full text-center bg-transparent border-none text-4xl font-bold text-primary p-0 focus:ring-0"
            placeholder="0">
    </div>
    <p x-show="amountError" class="text-danger text-xs mt-2" x-cloak>Jumlah harus diisi dan tidak boleh
        kosong dan minus</p>
</div>
