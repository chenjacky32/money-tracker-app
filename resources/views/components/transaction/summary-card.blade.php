@props(['summary'])

<div class="bg-background rounded-2xl border border-gray-200 p-4 shadow-sm flex mb-8">
    <x-ui.summary-item label="Pemasukan" value="+ Rp {{ number_format($summary['pemasukan'] ?? 0, 0, ',', '.') }}"
        valueClass="text-primary" :hasBorder="true" />
    <x-ui.summary-item label="Pengeluaran" value="- Rp {{ number_format($summary['pengeluaran'] ?? 0, 0, ',', '.') }}"
        valueClass="text-danger" :hasBorder="true" />
    <x-ui.summary-item label="Total"
        value="Rp {{ ($summary['total'] ?? 0) < 0 ? '-' : '' }} {{ number_format(abs($summary['total'] ?? 0), 0, ',', '.') }}"
        valueClass="text-gray-deep" />
</div>
