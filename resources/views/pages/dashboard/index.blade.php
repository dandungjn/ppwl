<x-app-layout>
    @section('title', 'Dashboard')

    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex align-items-center">
                <span style="font-size:2.5rem;" class="me-1">🎉</span>
                <h4 class="mb-0 fw-bold text-primary">Selamat datang di halaman Dashboard UTS PPWL!</h4>
            </div>
            <p class="mb-4 text-secondary">Kelola produk dan kategori dengan mudah, nikmati fitur modern dan tampilan
                menarik berbasis Laravel.</p>
            </p>
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <span class="avatar avatar-md bg-primary text-white rounded-circle"><i
                                        class="bx bx-box"></i></span>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">Total Produk</h6>
                                <h3 class="mb-0 fw-bold text-primary">{{ $productCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <span class="avatar avatar-md bg-info text-white rounded-circle"><i
                                        class="bx bx-category"></i></span>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">Total Kategori</h6>
                                <h3 class="mb-0 fw-bold text-info">{{ $categoryCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Produk Terbaru</h5>
                            <a href="{{ route('products.index') }}">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentProducts as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category ? $product->category->name : '-' }}</td>
                                            <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td>{{ $product->stock }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada produk.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0">Info Manajemen</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3"><i class="bx bx-check-circle text-success me-2"></i> CRUD Produk &
                                    Kategori</li>
                                <li class="mb-3"><i class="bx bx-search text-primary me-2"></i> Pencarian & Pagination
                                </li>
                                <li class="mb-3"><i class="bx bx-bell text-warning me-2"></i> Validasi & Notifikasi</li>
                                <li><i class="bx bx-paint text-info me-2"></i> UI modern Sneat + Bootstrap 5</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
