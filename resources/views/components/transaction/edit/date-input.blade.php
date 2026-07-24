<div class="relative mt-6">
    <div @click="datePickerOpen = !datePickerOpen"
        class="bg-background dark:bg-muted rounded-[20px] border border-gray-soft p-4 shadow-sm flex items-center justify-between cursor-pointer">
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
        class="absolute top-full left-0 mt-2 w-full max-w-sm bg-background dark:bg-muted border border-gray-soft rounded-xl shadow-lg p-4 z-50">
        <div class="flex justify-between items-center mb-4">
            <button @click.prevent="datePickerPreviousMonth()" type="button"
                class="p-1 text-gray-darker hover:bg-gray-soft rounded-full transition">
                <x-ui.icon name="chevron-left" class="w-5 h-5" />
            </button>
            <div class="font-bold text-gray-darker"
                x-text="datePickerMonthNames[datePickerMonth] + ' ' + datePickerYear">
            </div>
            <button @click.prevent="datePickerNextMonth()" type="button"
                class="p-1 text-gray-darker hover:bg-gray-soft rounded-full transition">
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
                        'text-gray-darker hover:bg-gray-soft': !datePickerIsSelectedDate(day)
                    }"
                    class="w-8 h-8 mx-auto flex justify-center items-center rounded-full text-sm transition"
                    x-text="day"></button>
            </template>
        </div>
    </div>
</div>
