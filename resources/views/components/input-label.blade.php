@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-gray-dark mb-2']) }}>
    {{ $value ?? $slot }}
</label>
