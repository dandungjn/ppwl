<x-app-layout>
    @section('title', 'Tambah Produk')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Tambah Produk" :breadcrumb="[
                'Produk' => route('products.index'),
                'Tambah Produk' => '',
            ]" />
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Form Tambah Produk</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="foto">Foto</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="name">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nama produk" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="category_id">Kategori</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="category_id" name="category_id">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="description">Deskripsi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi produk">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="price">Harga</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bx bx-money"></i></span>
                                            <input type="number" class="form-control" id="price" name="price"
                                                placeholder="Harga produk">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="stock">Stok</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bx bx-package"></i></span>
                                            <input type="number" class="form-control" id="stock" name="stock"
                                                placeholder="Stok produk">
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10 d-flex">
                                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-1"><i
                                                class="bx bx-save"></i> Simpan</button>
                                        <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        @if (session('success'))
            <script>
                Swal.fire({
                    toast: true,
                    position: 'bottom',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
            </script>
        @endif
        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    showConfirmButton: true,
                });
            </script>
        @endif
    @endpush
</x-app-layout>
