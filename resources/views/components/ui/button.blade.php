@props([
    'href' => null,
    'type' => 'button',
    'color' => 'primary',
    'icon' => null,
])

@php
    $classes = "btn btn-$color d-flex align-items-center gap-1";
    $tag = $href ? 'a' : 'button';
@endphp

@if ($tag === 'a')
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <i class="mdi mdi-{{ $icon }}"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <i class="mdi mdi-{{ $icon }}"></i>
        @endif
        {{ $slot }}
    </button>
@endif
