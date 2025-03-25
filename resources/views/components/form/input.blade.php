@props([
'type' => 'text',
'name',
'label' => null,
'placeholder' => '',
'required' => false
])

<div class="mb-4">
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" {{
        $attributes->merge(['class' => 'w-full px-3 py-2 border rounded-md focus:ring focus:ring-green-300']) }}
    {{ $required ? 'required' : '' }}
    >

    @error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>