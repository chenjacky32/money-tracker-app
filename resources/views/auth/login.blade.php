<x-guest-layout>
    <div class="px-6 py-12 flex flex-col min-h-screen bg-white">
        <div class="flex-1 flex flex-col justify-center max-w-sm mx-auto w-full">
            <div class="mb-10 text-center">
                <div
                    class="w-14 h-14 bg-[#F2F4F3] border border-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <x-ui.icon name="coin" class="w-7 h-7 text-primary" />
                </div>
                <h1 class="text-[32px] font-bold text-primary tracking-tight">Money Tracker</h1>
                <p class="text-gray-medium mt-3 text-[15px] leading-relaxed max-w-[280px] mx-auto">
                    Keuangan cerdas, masa depan terjamin. Pantau setiap langkah finansial Anda dengan presisi.
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
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
                    <x-ui.input type="password" id="password" name="password" required autocomplete="current-password"
                        placeholder="••••••••" class="bg-[#F8FAF9]">
                        <x-slot name="icon">
                            <x-ui.icon name="password" />
                        </x-slot>
                    </x-ui.input>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" id="remember_me" name="remember" {{ old('remember') ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-gray-300 text-primary checked:bg-primary checked:border-primary focus:ring-primary/20 bg-[#F8FAF9] transition-colors duration-200 cursor-pointer">
                        <span class="text-[13px] text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-[13px] font-semibold text-primary hover:underline">Lupa Password?</a>
                </div>

                {{-- Sign In --}}
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-primary text-white rounded-xl py-3.5 font-bold text-[15px] hover:bg-primary/90 transition shadow-sm">
                        Sign In
                    </button>
                </div>
            </form>

            {{-- Or --}}
            {{-- <div class="mt-8 mb-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-light">or</span>
                    </div>
                </div>
            </div> --}}

            {{-- <button type="button"
                class="w-full bg-[#F8FAF9] border border-gray-200 text-gray-darker rounded-xl py-3.5 font-medium text-[15px] hover:bg-gray-100 transition flex items-center justify-center gap-3">
                <x-ui.icon name="google" />
                Lanjutkan dengan Google
            </button> --}}
        </div>

        <p class="text-center text-[15px] text-gray-medium mt-auto pt-8">
            Don't have an account? <a href="{{ route('register') }}" class="font-bold text-primary hover:underline">Sign
                up</a>
        </p>
    </div>
</x-guest-layout>
