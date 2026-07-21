<div x-data="{ switchOn: false }" class="flex items-center justify-center space-x-2">
    <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="switchOn">

    <label @click="$refs.switchButton.click(); $refs.switchButton.focus()" :id="$id('switch')"
        :class="{ 'text-primary': switchOn, 'text-gray-muted': !switchOn }" class="text-sm select-none" x-cloak>
        <span x-text="switchOn ? 'Gelap' : 'Terang'"></span></label>

    <button x-ref="switchButton" type="button" @click="switchOn = ! switchOn"
        :class="switchOn ? 'bg-primary' : 'bg-gray-100'"
        class="relative inline-flex h-6 py-0.5 ml-4 focus:outline-none rounded-full w-10" x-cloak>
        <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'"
            class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
    </button>
</div>
