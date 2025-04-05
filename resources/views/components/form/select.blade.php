@props([
'label' => '',
'name' => '',
'wireModel' => null,
])

<div class="mb-4">
    @if($label)
    <label class="block text-gray-800 font-semibold mb-1" for="{{ $name }}">{{ $label }}</label>
    @endif
    <select name="{{ $name }}" id="{{ $name }}" {{ $wireModel ? "wire:model={$wireModel}" : '' }} {{
        $attributes->merge(['class' => 'w-full p-2 border border-gray-300 rounded-md bg-white text-gray-900']) }}
        >
        {{ $slot }}
    </select>
</div>