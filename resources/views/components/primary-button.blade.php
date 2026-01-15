@props([
    'type' => 'button',
    'class' => '',
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => "btn btn-primary $class"]) }}>
    {{ $slot }}
</button>
