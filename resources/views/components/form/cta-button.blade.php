@props([
'type' => 'button'
])
<button type="{{ $type }}" {{ $attributes->merge(['class' => 'w-full p-3 bg-blue-600 text-white font-semibold rounded-lg
    hover:bg-blue-700 transition']) }}>
    {{ $slot }}
</button>