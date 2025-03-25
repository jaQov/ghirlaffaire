<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <div>
        @foreach ($options as $value => $text)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="{{ $name }}" value="{{ $value }}" {{ $required
                ? 'required' : '' }}>
            <label class="form-check-label">{{ $text }}</label>
        </div>
        @endforeach
    </div>
</div>