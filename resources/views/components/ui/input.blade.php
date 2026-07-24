@props(['disabled' => false, 'icon' => null])

<div class="relative w-full">
    @if ($icon)
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-primary">
            {{ $icon }}
        </div>
    @endif
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' =>
            'w-full rounded-2xl border border-gray-soft bg-muted text-gray-darker placeholder-gray-muted px-4 py-3 text-sm shadow-sm focus:border-primary focus:ring focus:ring-primary/20 transition-colors duration-200 ' .
            ($icon ? 'pl-11' : ''),
    ]) !!}>
</div>
