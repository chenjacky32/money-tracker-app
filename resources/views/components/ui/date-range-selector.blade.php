<div class="flex items-center justify-between bg-white rounded-2xl border border-gray-200 p-4 shadow-sm mb-6 gap-4">
    <!-- Start Date Trigger -->
    <div class="relative flex-1">
        <label class="block text-[10px] font-bold text-gray-medium uppercase tracking-wide mb-1">TANGGAL MULAI</label>
        <button type="button" @click="startPickerOpen = !startPickerOpen; endPickerOpen = false"
            class="w-full flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-sm font-semibold text-gray-deep hover:bg-gray-100/70 transition cursor-pointer">
            <span x-text="formatDisplayDate(startDate)"></span>
            <x-ui.icon name="calendar" class="w-4 h-4 text-primary" />
        </button>

        <!-- Start Datepicker Popover Modal -->
        <div x-show="startPickerOpen" @click.away="startPickerOpen = false" x-transition x-cloak
            class="absolute left-0 top-full mt-2 w-64 bg-white border border-gray-200 rounded-xl shadow-lg p-4 z-50">

            <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100">
                <button @click.prevent="startPickerPreviousMonth()" type="button"
                    class="p-1 hover:bg-gray-100 rounded-full transition text-gray-light cursor-pointer">
                    <x-ui.icon name="chevron-left" class="w-5 h-5" />
                </button>
                <div class="font-bold text-gray-deep text-sm"
                    x-text="datePickerMonthNames[startPickerMonth] + ' ' + startPickerYear"></div>
                <button @click.prevent="startPickerNextMonth()" type="button"
                    class="p-1 hover:bg-gray-100 rounded-full transition text-gray-light cursor-pointer">
                    <x-ui.icon name="chevron-right-thick" class="w-5 h-5" />
                </button>
            </div>

            <div class="grid grid-cols-7 mb-2">
                <template x-for="day in datePickerDays" :key="day">
                    <div class="text-center text-[10px] font-bold text-gray-light" x-text="day"></div>
                </template>
            </div>

            <div class="grid grid-cols-7 gap-1">
                <template x-for="blankDay in startPickerBlankDaysInMonth">
                    <div class="p-1 text-sm text-center border border-transparent"></div>
                </template>
                <template x-for="day in startPickerDaysInMonth" :key="day">
                    <button @click.prevent="startPickerDayClicked(day)" type="button"
                        :class="{
                            'bg-primary text-white': startPickerIsSelectedDate(day),
                            'text-gray-deep hover:bg-gray-100': !startPickerIsSelectedDate(day)
                        }"
                        class="w-7 h-7 mx-auto flex justify-center items-center rounded-full text-xs font-semibold transition cursor-pointer"
                        x-text="day"></button>
                </template>
            </div>
        </div>
    </div>

    <!-- Separator Icon -->
    <div class="text-gray-medium pt-5">
        <x-ui.icon name="chevron-right-thick" class="w-4 h-4" />
    </div>

    <!-- End Date Trigger -->
    <div class="relative flex-1">
        <label class="block text-[10px] font-bold text-gray-medium uppercase tracking-wide mb-1">TANGGAL SELESAI</label>
        <button type="button" @click="endPickerOpen = !endPickerOpen; startPickerOpen = false"
            class="w-full flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-sm font-semibold text-gray-deep hover:bg-gray-100/70 transition cursor-pointer">
            <span x-text="formatDisplayDate(endDate)"></span>
            <x-ui.icon name="calendar" class="w-4 h-4 text-primary" />
        </button>

        <!-- End Datepicker Popover Modal -->
        <div x-show="endPickerOpen" @click.away="endPickerOpen = false" x-transition x-cloak
            class="absolute right-0 top-full mt-2 w-64 bg-white border border-gray-200 rounded-xl shadow-lg p-4 z-50">

            <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100">
                <button @click.prevent="endPickerPreviousMonth()" type="button"
                    class="p-1 hover:bg-gray-100 rounded-full transition text-gray-light cursor-pointer">
                    <x-ui.icon name="chevron-left" class="w-5 h-5" />
                </button>
                <div class="font-bold text-gray-deep text-sm"
                    x-text="datePickerMonthNames[endPickerMonth] + ' ' + endPickerYear"></div>
                <button @click.prevent="endPickerNextMonth()" type="button"
                    class="p-1 hover:bg-gray-100 rounded-full transition text-gray-light cursor-pointer">
                    <x-ui.icon name="chevron-right-thick" class="w-5 h-5" />
                </button>
            </div>

            <div class="grid grid-cols-7 mb-2">
                <template x-for="day in datePickerDays" :key="day">
                    <div class="text-center text-[10px] font-bold text-gray-light" x-text="day"></div>
                </template>
            </div>

            <div class="grid grid-cols-7 gap-1">
                <template x-for="blankDay in endPickerBlankDaysInMonth">
                    <div class="p-1 text-sm text-center border border-transparent"></div>
                </template>
                <template x-for="day in endPickerDaysInMonth" :key="day">
                    <button @click.prevent="endPickerDayClicked(day)" type="button"
                        :class="{
                            'bg-primary text-white': endPickerIsSelectedDate(day),
                            'text-gray-deep hover:bg-gray-100': !endPickerIsSelectedDate(day)
                        }"
                        class="w-7 h-7 mx-auto flex justify-center items-center rounded-full text-xs font-semibold transition cursor-pointer"
                        x-text="day"></button>
                </template>
            </div>
        </div>
    </div>
</div>
