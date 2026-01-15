@props(['src'])

@php
    $url = $src ? asset('storage/' . ltrim($src, '/')) : asset('images/placeholder.png');
@endphp

<a href="{{ $url }}" target="_blank" rel="noopener noreferrer">
    <img src="{{ $url }}" alt="image" style="max-height:60px;max-width:120px;object-fit:cover;border-radius:4px;" />
</a>
