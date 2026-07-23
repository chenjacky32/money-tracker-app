<div x-data="themeToggle" class="flex items-center justify-center">
    <button type="button" 
        @click="toggleTheme()"
        class="relative inline-flex items-center justify-center p-2 rounded-full text-gray-light hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-dark transition-colors duration-200 focus:outline-none cursor-pointer"
        aria-label="Toggle Dark Mode">
        
        <!-- Sun icon for light mode (shows when dark mode is ON) -->
        <x-ui.icon name="sun" class="w-5 h-5 text-amber-500" x-show="isDark" x-cloak />
        
        <!-- Moon icon for dark mode (shows when dark mode is OFF) -->
        <x-ui.icon name="moon" class="w-5 h-5 text-gray-dark" x-show="!isDark" x-cloak />
    </button>
</div>
