<x-guest-layout>
    <x-guest-layout>
        <div class="px-6 py-12 flex flex-col min-h-screen bg-white">
            <div class="flex-1 flex flex-col justify-center max-w-sm mx-auto w-full">
                <div class="mb-10 text-center">
                    <div
                        class="w-14 h-14 bg-[#F2F4F3] border border-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <x-ui.icon name="user-plus" class="w-8 h-8 text-primary" />
                    </div>
                    <!-- Tag Konteks Kecil di atas nama aplikasi -->
                    <span
                        class="text-sm font-bold uppercase tracking-widest text-primary/60 block mb-1">Registrasi</span>
                    <h1 class="text-[32px] font-bold text-primary tracking-tight">Money Tracker</h1>
                    <p class="text-gray-medium mt-3 text-[15px] leading-relaxed max-w-[280px] mx-auto">
                        Keuangan cerdas, masa depan terjamin. Pantau setiap langkah finansial Anda dengan presisi.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-ui.input type="text" id="name" name="name" :value="old('name')" required autofocus
                            placeholder="Enter your name" class="bg-[#F8FAF9]">
                            <x-slot name="icon">
                                <x-ui.icon name="person" />
                            </x-slot>
                        </x-ui.input>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-ui.input type="email" id="email" name="email" :value="old('email')" required autofocus
                            placeholder="Enter your email" class="bg-[#F8FAF9]">
                            <x-slot name="icon">
                                <x-ui.icon name="email" />
                            </x-slot>
                        </x-ui.input>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-ui.input type="password" id="password" name="password" required
                            autocomplete="current-password" placeholder="••••••••" class="bg-[#F8FAF9]">
                            <x-slot name="icon">
                                <x-ui.icon name="password" />
                            </x-slot>
                        </x-ui.input>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-ui.input type="password" id="password_confirmation" name="password_confirmation" required
                            autocomplete="current-password" placeholder="••••••••" class="bg-[#F8FAF9]">
                            <x-slot name="icon">
                                <x-ui.icon name="password" />
                            </x-slot>
                        </x-ui.input>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Sign In --}}
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-primary text-white rounded-xl py-3.5 font-bold text-[15px] hover:bg-primary/90 transition shadow-sm">
                            Register
                        </button>
                    </div>
                </form>
            </div>

            <p class="text-center text-[15px] text-gray-medium mt-auto pt-8">
                Already registered? <a href="{{ route('login') }}" class="font-bold text-primary hover:underline">Log
                    In
                </a>
            </p>
        </div>
    </x-guest-layout>
</x-guest-layout>
