@extends('layouts.guest')

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
                        Website sederhana ini dibuat menggunakan Laravel + Bootstrap (Sneat Template).
                        Silakan jelajahi fitur yang tersedia atau mulai dengan login/register.
                    </p>

                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-2">
                            Mulai Sekarang
                        </a>

                        <a href="#destinations" class="btn btn-outline-primary btn-lg px-4">
                            Lihat Destinasi
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 text-center mt-4 mt-lg-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/201/201623.png" class="img-fluid"
                        style="max-width: 350px;" alt="Hero Illustration">
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations -->
    <section id="destinations" class="py-5">
        <div class="container">
            <h2 class="fw-bold text-center text-primary mb-5">Holiday Destinations</h2>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" class="card-img-top"
                            alt="Beach">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">Beautiful Beach</h5>
                            <p class="card-text">Nikmati suasana pantai yang indah dan menenangkan.</p>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee" class="card-img-top"
                            alt="Mountain">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">Mountain View</h5>
                            <p class="card-text">Rasakan udara sejuk dan pemandangan pegunungan.</p>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://images.unsplash.com/photo-1472214103451-9374bd1c798e" class="card-img-top"
                            alt="City Lights">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">City Lights</h5>
                            <p class="card-text">Jelajahi kota modern dengan lampu gemerlap.</p>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white py-3 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }} — All rights reserved.</p>
        </div>
    </footer>
@endsection
