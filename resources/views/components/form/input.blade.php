@props(['name', 'label', 'type' => 'text', 'value' => '', 'placeholder' => null])

<div class="row mb-3 align-items-center">
    <label class="col-sm-2 col-form-label" for="{{ $name }}">{{ $label }}</label>

    <div class="col-sm-10">
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
            value="{{ old($name, $value) }}" placeholder="{{ $placeholder ?? $label }}"
            class="form-control @error($name) is-invalid @enderror" {{ $attributes }}>

        @error($name)
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
