@props(['name', 'label', 'value' => '', 'placeholder' => null, 'rows' => 4])

<div class="row mb-3 align-items-center">
    <label class="col-sm-2 col-form-label" for="{{ $name }}">{{ $label }}</label>

    <div class="col-sm-10">
        <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder ?? $label }}"
            class="form-control @error($name) is-invalid @enderror" {{ $attributes }}>{{ old($name, $value) }}</textarea>

        @error($name)
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
