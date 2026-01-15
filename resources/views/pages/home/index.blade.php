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
                            <a class="btn btn-primary px-4" href="{{ route('dashboard') }}">Dashboard Toko</a>
                        </li>
                    @else
                        <li class="nav-item mx-1">
                            <a class="btn btn-primary px-4" href="{{ route('login') }}">Masuk</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="btn btn-outline-primary px-4" href="{{ route('register') }}">Daftar</a>
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
                        Kelola Toko Anda Lebih Mudah
                    </h1>
                    <p class="lead text-secondary">
                        {{ config('app.name') }} adalah aplikasi manajemen toko berbasis web untuk membantu Anda
                        mengelola furnitur, stok barang, transaksi penjualan, pelanggan, serta laporan keuangan
                        secara efisien dan terintegrasi.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-2">
                            Mulai Kelola Toko
                        </a>
                        <a href="#features" class="btn btn-outline-primary btn-lg px-4">
                            Lihat Fitur
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 text-center mt-4 mt-lg-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png"
                        class="img-fluid"
                        style="max-width: 350px;"
                        alt="Store Management Illustration">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="fw-bold text-center text-primary mb-5">Fitur Utama Manajemen Toko</h2>

            <div class="row g-4">
                <!-- Card 1: furnitur & Stok -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bx bx-package text-primary" style="font-size: 2.5rem;"></i>
                            <h5 class="card-title text-primary fw-bold mt-3">Manajemen furnitur & Stok</h5>
                            <p class="card-text">
                                Kelola data furnitur, kategori, harga, dan stok barang secara real-time.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Penjualan -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bx bx-cart text-primary" style="font-size: 2.5rem;"></i>
                            <h5 class="card-title text-primary fw-bold mt-3">Transaksi Penjualan</h5>
                            <p class="card-text">
                                Catat transaksi penjualan dengan cepat, rapi, dan terintegrasi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Laporan -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bx bx-line-chart text-primary" style="font-size: 2.5rem;"></i>
                            <h5 class="card-title text-primary fw-bold mt-3">Laporan & Analisis</h5>
                            <p class="card-text">
                                Pantau laporan penjualan, stok, dan keuntungan untuk pengambilan keputusan.
                            </p>
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
                    &copy; {{ date('Y') }} {{ config('app.name') }}
                </b>
                — Sistem Manajemen Toko.
            </p>
        </div>
    </footer>
@endsection
