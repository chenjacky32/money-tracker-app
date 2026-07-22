    <!-- Header UI Component -->
    <div x-data="headerNav"
        class="fixed w-full max-w-md mx-auto top-0 left-0 right-0 px-6 py-4 bg-background/90 backdrop-blur-md border-b border-gray-200/80 z-40 flex items-center justify-between shadow-[0_2px_12px_-3px_rgba(0,0,0,0.04)]">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center text-primary cursor-pointer">
                <x-ui.icon name="wallet-solid" class="w-4 h-4" />
            </div>
            <h1 class="text-lg font-bold text-primary tracking-tight">Money Tracker App</h1>
        </div>
        <x-ui.theme-switch />
        <button @click="toggleNotification()"
            class="w-10 h-10 bg-white border border-gray-200/60 rounded-full flex items-center justify-center text-primary shadow-sm hover:bg-gray-50 transition cursor-pointer">
            <x-ui.icon name="bell" x-show="!isBellClicked" class="w-5 h-5" />
            <x-ui.icon name="silent-bell" x-show="isBellClicked" class="w-5 h-5" x-cloak />
        </button>
    </div>
