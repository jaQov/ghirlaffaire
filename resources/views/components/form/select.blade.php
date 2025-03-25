@props([
'name',
'label' => null,
'options' => [],
'required' => false
])

<div class="mb-4">
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'w-full px-3 py-2 border rounded-md
        focus:ring focus:ring-green-300']) }}
        {{ $required ? 'required' : '' }}
        >
        <option value="">Select an option</option>
        @foreach($options as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>

    @error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>