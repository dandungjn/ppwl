<x-app-layout>
    @section('title', 'Daftar Produk')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Produk" :breadcrumb="[
                'Produk' => route('products.index'),
                'Daftar Produk' => '',
            ]">
                <a href="{{ route('products.create') }}" class="btn btn-primary d-flex align-items-center">
                    <i class="bx bx-plus"></i> Tambah Produk
                </a>
            </x-page-header>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <form action="{{ route('products.index') }}" method="GET" class="d-flex align-items-center"
                        style="width: 100%; gap: 1rem;">
                        <input type="text" name="search" class="form-control me-2" placeholder="Cari..."
                            value="{{ request('search') }}" style="max-width: 300px;">
                        <select name="per_page" class="form-select me-2" style="width: 100px;"
                            onchange="this.form.submit()">
                            @foreach([5, 10, 20, 50, 100] as $size)
                                <option value="{{ $size }}" @if(request('per_page', 10) == $size) selected @endif>
                                    {{ $size }}/halaman
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="bx bx-search"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                        </td>
                                        <td>
                                            @if($product->photo)
                                                <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}"
                                                    class="imgthumbnail" width="80">
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category ? $product->category->name : '-' }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-delete-product">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada produk ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $products->links('vendor.pagination.sneat') }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.btn-delete-product').forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Yakin ingin menghapus produk ini?',
                            text: 'Data yang dihapus tidak dapat dikembalikan!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                btn.closest('form').submit();
                            }
                        });
                    });
                });
                @if (session('success'))
                    Swal.fire({
                        toast: true,
                        position: 'bottom',
                        icon: 'success',
                        title: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                @endif
            });
        </script>
    @endpush
</x-app-layout>
