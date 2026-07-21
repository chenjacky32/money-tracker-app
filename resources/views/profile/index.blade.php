<x-app-layout>
    <div class="px-6 py-5 bg-background sticky top-0 z-20">
        <h2 class="text-2xl font-bold text-primary">Profile</h2>

        <!-- User Info Section -->
        <div class="flex flex-col items-center text-center mb-8 mt-4">
            <div
                class="w-24 h-24 bg-gradient-to-tr from-primary to-secondary rounded-full flex items-center justify-center text-white text-3xl font-extrabold shadow-md mb-4 ring-4 ring-white overflow-hidden">
                @auth
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                @else
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop"
                        alt="Avatar" class="w-full h-full object-cover">
                @endauth
            </div>
            <h3 class="text-xl font-bold text-gray-deep">{{ auth()->check() ? auth()->user()->name : 'Alica Dev' }}</h3>
            <p class="text-sm text-gray-light mt-1">
                {{ auth()->check() ? auth()->user()->email : 'alica.dev@example.com' }}</p>
        </div>

        <!-- Menu List -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">
            <a href="#"
                class="flex items-center justify-between p-4 border-b border-gray-100 hover:bg-gray-50 transition">
                <div class="flex items-center gap-4 text-primary">
                    <x-ui.icon name="settings" class="w-5 h-5" />
                    <span class="text-base text-gray-darker">Pengaturan Akun</span>
                </div>
                <x-ui.icon name="chevron-right" class="w-5 h-5 text-gray-muted" />
            </a>

            <a href="#"
                class="flex items-center justify-between p-4 border-b border-gray-100 hover:bg-gray-50 transition">
                <div class="flex items-center gap-4 text-primary">
                    <x-ui.icon name="categories-grid" class="w-5 h-5" />
                    <span class="text-base text-gray-darker">Kategori Transaksi</span>
                </div>
                <x-ui.icon name="chevron-right" class="w-5 h-5 text-gray-muted" />
            </a>

            <a href="#"
                class="flex items-center justify-between p-4 border-b border-gray-100 hover:bg-gray-50 transition">
                <div class="flex items-center gap-4 text-primary">
                    <x-ui.icon name="export" class="w-5 h-5" />
                    <span class="text-base text-gray-darker">Ekspor Data (CSV/PDF)</span>
                </div>
                <x-ui.icon name="chevron-right" class="w-5 h-5 text-gray-muted" />
            </a>

            <a href="#"
                class="flex items-center justify-between p-4 border-b border-gray-100 hover:bg-gray-50 transition">
                <div class="flex items-center gap-4 text-primary">
                    <x-ui.icon name="help" class="w-5 h-5" />
                    <span class="text-base text-gray-darker">Bantuan & Dukungan</span>
                </div>
                <x-ui.icon name="chevron-right" class="w-5 h-5 text-gray-muted" />
            </a>

            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                <div class="flex items-center gap-4 text-primary">
                    <x-ui.icon name="info" class="w-5 h-5" />
                    <span class="text-base text-gray-darker">Tentang Aplikasi</span>
                </div>
                <x-ui.icon name="chevron-right" class="w-5 h-5 text-gray-muted" />
            </a>
        </div>

        <!-- Logout Button -->
        <button onclick="window.location.href='{{ route('home') }}'"
            class="w-full bg-[#B91C1C] cursor-pointer text-white rounded-xl py-4 text-base font-bold shadow-sm hover:bg-red-800 transition flex items-center justify-center gap-2">
            <x-ui.icon name="logout" class="w-5 h-5" />
            Logout
        </button>
    </div>
</x-app-layout>
