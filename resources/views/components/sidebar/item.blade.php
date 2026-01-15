@props(['route', 'label', 'icon', 'active' => null])

@php
    $isActive = $active ?? request()->routeIs($route);
@endphp

<li class="menu-item {{ $isActive ? 'active' : '' }}">
    <a href="{{ route(Str::replace('*', 'index', $route)) }}" class="menu-link">
        <i class="menu-icon tf-icons mdi {{ $isActive ? $icon : $icon . '-outline' }}"></i>
        <div>{{ $label }}</div>
    </a>
</li>
