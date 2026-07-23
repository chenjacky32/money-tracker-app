@props(['label', 'value', 'valueClass' => 'text-gray-deep', 'hasBorder' => false])

<div class="flex-1 text-center {{ $hasBorder ? 'border-r border-gray-100' : '' }}">
    <p class="text-xs font-bold text-gray-deep mb-1">{{ $label }}</p>
    <p class="text-sm font-medium {{ $valueClass }}">
        {{ $value }}
    </p>
</div>
