@props(['type' => 'button', 'variant' => 'primary', 'fullWidth' => true])

@php
    $classes =
        'inline-flex justify-center items-center rounded-full px-6 py-3 font-semibold text-sm transition focus:outline-none focus:ring-2 focus:ring-offset-2';

    if ($fullWidth) {
        $classes .= ' w-full';
    }

    if ($variant === 'primary') {
        $classes .= ' bg-primary text-white hover:bg-primary/90 focus:ring-primary';
    } elseif ($variant === 'danger') {
        $classes .= ' bg-danger text-white hover:bg-danger/90 focus:ring-danger';
    } elseif ($variant === 'outline') {
        $classes .= ' bg-transparent border-2 border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-gray-300';
    }
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
