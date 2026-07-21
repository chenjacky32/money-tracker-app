<x-guest-layout>
    <div class="px-6 py-12 flex flex-col min-h-screen bg-white">
        <div class="flex-1 flex flex-col justify-center max-w-sm mx-auto w-full">
            <div class="mb-10 text-center">
                <div
                    class="w-14 h-14 bg-[#F2F4F3] border border-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                </div>
                <h1 class="text-[32px] font-bold text-primary tracking-tight">Money Tracker</h1>
                <p class="text-gray-600 mt-3 text-[15px] leading-relaxed max-w-[280px] mx-auto">
                    Keuangan cerdas, masa depan terjamin. Pantau setiap langkah finansial Anda dengan presisi.
                </p>
            </div>

            <form class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-dark mb-2">Email</label>
                    <x-ui.input type="email" id="email" placeholder="Enter your email" class="bg-[#F8FAF9]">
                        <x-slot name="icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </x-slot>
                    </x-ui.input>
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-dark mb-2">Password</label>
                    <x-ui.input type="password" id="password" placeholder="••••••••" class="bg-[#F8FAF9]">
                        <x-slot name="icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </x-slot>
                    </x-ui.input>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox"
                            class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary/20 bg-[#F8FAF9]">
                        <span class="text-[13px] text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-[13px] font-semibold text-primary hover:underline">Lupa Password?</a>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-primary text-white rounded-xl py-3.5 font-bold text-[15px] hover:bg-primary/90 transition shadow-sm">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="mt-8 mb-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-light">or</span>
                    </div>
                </div>
            </div>

            <button type="button"
                class="w-full bg-[#F8FAF9] border border-gray-200 text-gray-800 rounded-xl py-3.5 font-medium text-[15px] hover:bg-gray-100 transition flex items-center justify-center gap-3">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4"
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                    <path fill="#34A853"
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                    <path fill="#FBBC05"
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                    <path fill="#EA4335"
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                </svg>
                Lanjutkan dengan Google
            </button>
        </div>

        <p class="text-center text-[15px] text-gray-600 mt-auto pt-8">
            Don't have an account? <a href="#" class="font-bold text-primary hover:underline">Sign up</a>
        </p>
    </div>
</x-guest-layout>
