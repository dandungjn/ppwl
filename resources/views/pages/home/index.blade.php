@extends('layouts.guest')

@section('title', 'Beranda')

@section('content')
    <!-- Navbar -->
    <nav class="layout-navbar container-fluid navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                {{ config('app.name') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item mx-1">
                            <a class="btn btn-primary px-4" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item mx-1">
                            <a class="btn btn-primary px-4" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="btn btn-outline-primary px-4" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <!-- /Navbar -->

    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-3 text-primary">
                        Selamat Datang di {{ config('app.name') }}
                    </h1>
                    <p class="lead text-secondary">
                        Aplikasi manajemen proyek, karyawan, dan data bisnis berbasis Laravel & Sneat. Kelola data proyek, tim, karyawan, pencatatan, pencarian, dan notifikasi dengan mudah.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-2">
                            Mulai Manajemen
                        </a>
                        <a href="" class="btn btn-outline-primary btn-lg px-4">
                            Lihat Proyek
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 text-center mt-4 mt-lg-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/1041/1041916.png" class="img-fluid"
                        style="max-width: 350px;" alt="Product Management Illustration">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="fw-bold text-center text-primary mb-5">Fitur Utama</h2>

            <div class="row g-4">
                <!-- Card 1: Proyek -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bx bx-briefcase text-primary" style="font-size: 2.5rem;"></i>
                            <h5 class="card-title text-primary fw-bold mt-3">Manajemen Proyek</h5>
                            <p class="card-text">Tambah, edit, hapus, dan pantau proyek dengan mudah.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Karyawan -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bx bx-user text-primary" style="font-size: 2.5rem;"></i>
                            <h5 class="card-title text-primary fw-bold mt-3">Manajemen Karyawan</h5>
                            <p class="card-text">Kelola data karyawan, tim, dan peran dengan efisien.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Notifikasi & Validasi -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bx bx-bell text-primary" style="font-size: 2.5rem;"></i>
                            <h5 class="card-title text-primary fw-bold mt-3">Validasi & Notifikasi</h5>
                            <p class="card-text">Dapatkan feedback instan saat mengelola data proyek dan karyawan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white py-3 mt-5">
        <div class="container text-center">
            <p class="mb-0">
                <b>
                    &copy; {{ date('Y') }} DungStore
                </b>
                — All rights reserved.
            </p>
        </div>
    </footer>
@endsection
