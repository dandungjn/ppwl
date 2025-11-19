<x-app-layout>
    @section('title', 'Daftar Kategori')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Kategori" :breadcrumb="[
                'Kategori' => route('categories.index'),
                'Daftar Kategori' => '',
            ]">
                <a href="{{ route('categories.create') }}" class="btn btn-primary d-flex align-items-center">
                    <i class="bx bx-plus"></i> Tambah Kategori
                </a>
            </x-page-header>
            <!-- Responsive Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <!-- Search & Per Page Form -->
                    <form action="{{ route('categories.index') }}" method="GET" class="d-flex align-items-center"
                        style="width: 100%; gap: 1rem;">
                        <input type="text" name="search" class="form-control me-2" placeholder="Cari..."
                            value="{{ request('search') }}" style="max-width: 300px;">
                        <select name="per_page" class="form-select me-2" style="width: 100px;" onchange="this.form.submit()">
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
                                    <th>Nama</th>
                                    <th>Jumlah Produk</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->products()->count() }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-delete-category">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada kategori ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $categories->links('vendor.pagination.sneat') }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.btn-delete-category').forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Yakin ingin menghapus kategori ini?',
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
