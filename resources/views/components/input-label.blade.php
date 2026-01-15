@props(['for' => null, 'value' => null])

<label {{ $for ? "for=$for" : '' }} {{ $attributes->merge(['class' => 'form-label fw-semibold']) }}>
    {{ $value ?? $slot }}
</label>
