@props([
'label' => '',
'name' => '',
'options' => [],
'required' => false,
])

@php
// Extract the wire:model.live attribute if present.
$wireModel = $attributes->get('wire:model.live') ?? $attributes->get('wire:model');
@endphp

<div class="mb-3">
    @if($label)
    <label class="block text-gray-800 font-semibold mb-1">{{ $label }}</label>
    @endif
    <div class="flex space-x-4">
        @foreach ($options as $value => $text)
        <label class="inline-flex items-center">
            <input type="radio" name="{{ $name }}" value="{{ $value }}" {{ $required ? 'required' : '' }}
                wire:model.live="{{ $wireModel }}" {{ $attributes->except(['wire:model.live',
            'wire:model'])->merge(['class' => 'form-radio text-blue-600']) }}
            >
            <span class="ml-2 text-gray-800">{{ $text }}</span>
        </label>
        @endforeach
    </div>
</div>