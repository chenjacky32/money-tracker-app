<!-- Donut Chart Area -->
<div class="bg-background rounded-3xl p-6 shadow-sm border border-gray-deep mb-8 flex justify-center relative">
    <div class="relative w-48 h-48">
        <!-- ChartJS Canvas -->
        <canvas id="pieChart" class="w-full h-full"></canvas>

        <!-- Inner Text -->
        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
            <p class="text-xs font-bold text-gray-light uppercase tracking-wide">Total</p>
            <p class="text-xl font-bold text-gray-deep mt-1"
                x-text="SelectedTransactionType === 'pemasukan' ? 'Rp ' + formatRupiah(summary.pemasukan) : 'Rp ' + formatRupiah(summary.pengeluaran)">
            </p>
        </div>
    </div>
</div>
