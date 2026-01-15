<style>
    .menu-search-box {
        position: absolute;
        top: 40px;
        left: 35px;
        min-width: 260px;
        max-height: 300px;
        overflow-y: auto;

        border-radius: 10px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        background: #fff;
        box-shadow: 0px 12px 32px rgba(0, 0, 0, 0.12);

        opacity: 0;
        transform: translateY(8px) scale(0.98);
        pointer-events: none;
        transition: all .22s cubic-bezier(.25, .1, .25, 1);
    }

    .menu-search-box.active {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    .search-item {
        display: block;
        padding: 10px 12px;
        border-radius: 8px;
        transition: background 0.2s ease, transform 0.15s ease;
        text-decoration: none;
        color: #009688;
        /* default title color = teal */
    }

    .search-item:hover {
        background-color: #d1f2eb;
        /* light teal hover */
        color: #008678;
        /* teks lebih gelap saat hover */
        transform: translateX(2px);
    }

    .search-item .search-route {
        font-size: 11px;
        color: #495057;
        margin-top: 2px;
    }

    /* hilangkan style link browser default / bootstrap */
    .search-item:focus,
    .search-item:active {
        outline: none;
        box-shadow: none;
    }
</style>

<!-- Navbar Sneat -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4 display-6" href="javascript:void(0)">
            <i class="mdi mdi-menu"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="mdi mdi-magnify fs-4 lh-0"></i>
                <div class="nav-item d-flex align-items-center position-relative">

                    <input id="menu-search" type="text" class="form-control border-0 shadow-none"
                        placeholder="Search..." aria-label="Search..." />

                    <!-- Dropdown result -->
                    <div id="menu-search-result" class="menu-search-box p-2"
                        style="position:absolute; top:40px; left:35px; min-width:260px; max-height:300px; overflow-y:auto;">
                    </div>
                </div>
            </div>
        </div>
        <!-- /Search -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User dropdown -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ optional(Auth::user())->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('sneat/assets/img/avatars/1.png') }}"
                            alt style="width:40px;height:40px;object-fit:cover;" class="rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ optional(Auth::user())->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('sneat/assets/img/avatars/1.png') }}"
                                            alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name ?? 'N/A' }}</span>
                                    <small class="text-muted">{{ Auth::user()->email ?? 'N/A' }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="">
                            <i class="mdi mdi-account-outline me-2"></i>
                            <span class="align-middle">Profil Saya</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="mdi mdi-cog-outline me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item btn-confirm text-danger d-flex align-items-center" href="#" data-confirm-title="Logout?"
                            data-confirm-text="Apakah kamu yakin ingin logout?">
                            <i class="mdi mdi-power me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
