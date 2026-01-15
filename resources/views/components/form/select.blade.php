@props(['name', 'label', 'options' => [], 'selected' => null])

<div class="row mb-3 align-items-center">
    <label class="col-sm-2 col-form-label" for="{{ $name }}">{{ $label }}</label>

    <div class="col-sm-10">
        <select id="{{ $name }}" name="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
            <option value="">Pilih {{ $label }}</option>

            @foreach ($options as $key => $optionLabel)
                <option value="{{ $key }}" @selected(old($name, $selected) == $key)>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>

        @error($name)
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
