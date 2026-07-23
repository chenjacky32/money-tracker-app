<div
    class="fixed bottom-0 w-full max-w-md bg-background border-t border-gray-100 flex justify-between items-center px-8 py-3 z-50 rounded-t-3xl shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
    <a href="{{ route('home') }}"
        class="flex flex-col items-center {{ request()->routeIs('home') ? 'text-secondary' : 'text-gray-light hover:text-secondary' }}">
        @if (request()->routeIs('home'))
            <div class="bg-secondary text-white p-1 rounded-lg mb-1">
                <x-ui.icon name="home-solid" class="w-6 h-6" />
            </div>
            <span class="text-xs font-bold">Home</span>
        @else
            <x-ui.icon name="home-outline" class="w-6 h-6 mb-1" />
            <span class="text-xs font-medium">Home</span>
        @endif
    </a>

    <a href="{{ route('transactions.index') }}"
        class="flex flex-col items-center {{ request()->routeIs('transactions.index') ? 'text-secondary' : 'text-gray-light hover:text-secondary' }}">
        @if (request()->routeIs('transactions.index'))
            <div class="bg-secondary text-white p-1 rounded-lg mb-1">
                <x-ui.icon name="wallet-solid" class="w-6 h-6" />
            </div>
            <span class="text-xs font-bold">Transactions</span>
        @else
            <x-ui.icon name="wallet-outline" class="w-6 h-6 mb-1" />
            <span class="text-xs font-medium">Transactions</span>
        @endif
    </a>

    <a href="{{ route('reports') }}"
        class="flex flex-col items-center {{ request()->routeIs('reports') ? 'text-secondary' : 'text-gray-light hover:text-secondary' }}">
        @if (request()->routeIs('reports'))
            <div class="bg-secondary text-white p-1 rounded-lg mb-1">
                <x-ui.icon name="reports-solid" class="w-6 h-6" />
            </div>
            <span class="text-xs font-bold">Reports</span>
        @else
            <x-ui.icon name="reports-outline" class="w-6 h-6 mb-1" />
            <span class="text-xs font-medium">Reports</span>
        @endif
    </a>

    <a href="{{ route('profile') }}"
        class="flex flex-col items-center {{ request()->routeIs('profile') ? 'text-secondary' : 'text-gray-light hover:text-secondary' }}">
        @if (request()->routeIs('profile'))
            <div class="bg-secondary text-white p-1 rounded-lg mb-1">
                <x-ui.icon name="profile-solid" class="w-6 h-6" />
            </div>
            <span class="text-xs font-bold">Profile</span>
        @else
            <x-ui.icon name="profile-outline" class="w-6 h-6 mb-1" />
            <span class="text-xs font-medium">Profile</span>
        @endif
    </a>
</div>
