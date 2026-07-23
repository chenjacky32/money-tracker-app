@props(['selectedMonthYear'])

<div class="flex bg-primary/60 p-1 rounded-xl mb-4">
    <button type="button" @click="SelectedPeriodType = 'bulanan'"
        :class="SelectedPeriodType === 'bulanan' ? 'bg-background text-gray-deep shadow-sm rounded-lg' :
            'text-gray-dark hover:text-gray-deep'"
        class="flex-1 py-1.5 text-sm font-semibold transition cursor-pointer">Bulanan</button>
    <button type="button" @click="SelectedPeriodType = 'rentang_tanggal'"
        :class="SelectedPeriodType === 'rentang_tanggal' ? 'bg-background text-gray-deep shadow-sm rounded-lg' :
            'text-gray-dark hover:text-gray-deep'"
        class="flex-1 py-1.5 text-sm font-semibold transition cursor-pointer">Rentang Tanggal</button>
</div>

<div x-show="SelectedPeriodType === 'bulanan'" x-transition>
    <x-ui.month-selector :selectedMonthYear="$selectedMonthYear" />
</div>

<div x-show="SelectedPeriodType === 'rentang_tanggal'" x-transition x-cloak>
    <x-ui.date-range-selector />
</div>
