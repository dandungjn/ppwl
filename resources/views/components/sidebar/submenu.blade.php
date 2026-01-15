@props([
    'title',
    'icon',
    'routes' => [],
])

@php
    $isOpen = false;
    foreach ($routes as $child) {
        if (request()->routeIs($child['route'])) {
            $isOpen = true;
            break;
        }
    }
@endphp

<li class="menu-item {{ $isOpen ? 'open' : '' }}">
    <a class="menu-link menu-toggle cursor-pointer">
        <i class="menu-icon tf-icons mdi {{ $isOpen ? $icon : $icon . '-outline' }}"></i>
        <div>{{ $title }}</div>
    </a>

    <ul class="menu-sub">
        @foreach ($routes as $item)
            @php
                $isActive = request()->routeIs($item['route']);
                $childIcon = $item['icon'] ?? null;
            @endphp

            <li class="menu-item {{ $isActive ? 'active' : '' }}">
                <a href="{{ route(Str::replace('*', 'index', $item['route'])) }}" class="menu-link">

                    {{-- tampilkan icon hanya jika tidak null --}}
                    @if ($childIcon)
                        <i class="menu-icon tf-icons mdi {{ $isActive ? $childIcon : $childIcon . '-outline' }}"></i>
                    @endif

                    <div>{{ $item['label'] }}</div>
                </a>
            </li>
        @endforeach
    </ul>
</li>
