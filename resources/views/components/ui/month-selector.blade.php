<div x-data="monthSelector"
    class="flex items-center justify-between bg-white rounded-2xl border border-gray-200 p-4 shadow-sm mb-6 relative">
    <button @click="prevMonth()" type="button"
        class="cursor-pointer w-8 h-8 flex items-center justify-center text-primary hover:bg-gray-50 rounded-full transition">
        <x-ui.icon name="chevron-left" class="w-5 h-5" />
    </button>

    <span class="font-bold text-gray-deep text-lg" x-text="formattedMonthYear"></span>

    <div class="flex items-center gap-2">
        <button @click="nextMonth()" type="button"
            class="cursor-pointer w-8 h-8 flex items-center justify-center text-primary hover:bg-gray-50 rounded-full transition">
            <x-ui.icon name="chevron-right-thick" class="w-5 h-5" />
        </button>
        <button @click="datePickerOpen = !datePickerOpen" type="button"
            class="cursor-pointer w-10 h-10 flex items-center justify-center text-primary bg-white border border-gray-200 rounded-xl shadow-sm hover:bg-gray-50 transition">
            <x-ui.icon name="calendar" class="w-5 h-5" />
        </button>
    </div>

    <!-- Month Picker Modal (Pines UI style) -->
    <div x-show="datePickerOpen" @click.away="datePickerOpen = false" x-transition x-cloak
        class="absolute right-0 top-full mt-2 w-64 bg-white border border-gray-200 rounded-xl shadow-lg p-4 z-50">

        <!-- Year Selector Header -->
        <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100">
            <button @click="datePickerYear--; updateSelectedValue()" type="button"
                class="p-1 hover:bg-gray-100 rounded-full transition text-gray-light">
                <x-ui.icon name="chevron-left" class="w-5 h-5" />
            </button>
            <div class="font-bold text-gray-deep" x-text="datePickerYear"></div>
            <button @click="datePickerYear++; updateSelectedValue()" type="button"
                class="p-1 hover:bg-gray-100 rounded-full transition text-gray-light">
                <x-ui.icon name="chevron-right-thick" class="w-5 h-5" />
            </button>
        </div>

        <div class="grid grid-cols-3 gap-2">
            <template x-for="(month, index) in datePickerMonthNames" :key="index">
                <button @click="selectMonth(index)" type="button"
                    :class="{
                        'bg-primary text-white': datePickerMonth ===
                            index,
                        'text-gray-darker hover:bg-gray-100': datePickerMonth !== index
                    }"
                    class="py-2 text-sm font-medium rounded-lg transition" x-text="month.substring(0, 3)"></button>
            </template>
        </div>
    </div>
</div>
