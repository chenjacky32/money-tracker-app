@props(['total', 'label'])

<div class="bg-primary text-white rounded-2xl p-5 shadow-sm mb-5 relative overflow-hidden">
    <div class="relative z-10">
        <p class="text-xs font-bold tracking-wider mb-2 opacity-90 uppercase">{{ $label }}</p>
        <h1 class="text-2xl font-bold tracking-tight">Rp {{ number_format($total, 0, ',', '.') }}</h1>
    </div>
    <!-- Bank Icon in background -->
    <div class="absolute right-4 top-4 opacity-70">
        <x-ui.icon name="bank" class="w-8 h-8" />
    </div>
</div>
