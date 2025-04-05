@props([
'label' => '',
'type' => 'text',
'name' => '',
'placeholder' => '',
'value' => '',
'wireModel' => null,
])

<div class="mb-4">
    @if($label)
    <label class="block text-gray-800 font-semibold mb-1" for="{{ $name }}">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}"
        {{ $wireModel ? "wire:model={$wireModel}" : '' }} {{ $attributes->merge(['class' => 'w-full p-2 border
    border-gray-300 rounded-md bg-white text-gray-900']) }}
    >
    {{ $slot }}
</div>