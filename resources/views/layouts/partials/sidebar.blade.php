<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <x-application-logo class="w-10 h-10" />
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">
                {{ config('app.name') }}
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link ms-auto d-block d-xl-none"
            style="background: #009688 !important; font-size: 24px; padding: 4px; display: inline-flex; align-items: center; justify-content: center;">
            <i class="mdi mdi-chevron-left"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @php $menus = config('menu'); @endphp

        @foreach ($menus as $menu)
            @if ($menu['type'] === 'header')
                <x-sidebar.header :title="$menu['title']" />
            @elseif ($menu['type'] === 'item')
                <x-sidebar.item :route="$menu['route']" :label="$menu['label']" :icon="$menu['icon']" />
            @elseif ($menu['type'] === 'submenu')
                <x-sidebar.submenu :title="$menu['title']" :icon="$menu['icon']" :routes="$menu['routes']" />
            @endif
        @endforeach
    </ul>
</aside>
