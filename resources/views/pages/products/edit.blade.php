<x-app-layout>
    @section('title', 'Edit Produk')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Edit Produk" :breadcrumb="[
                'Produk' => route('products.index'),
                'Edit Produk' => '',
            ]" />
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Form Edit Produk</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="foto">Foto</label>
                                    <div class="col-sm-10">
                                        @if($product->photo)
                                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="imgthumbnail mb-2" width="80">
                                        @endif
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                                        @error('foto')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="name">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama produk" value="{{ old('name', $product->name) }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="category_id">Kategori</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                            <option value="">Pilih Kategori</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if(old('category_id', $product->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="description">Deskripsi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Deskripsi produk">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="price">Harga</label>
                                    <div class="col-sm-10">
                                        <div class="position-relative">
                                            <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted"><i class="bx bx-money"></i></span>
                                            <input type="number" class="form-control ps-5 @error('price') is-invalid @enderror" id="price" name="price" placeholder="Harga produk" value="{{ old('price', $product->price) }}">
                                        </div>
                                        @error('price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="stock">Stok</label>
                                    <div class="col-sm-10">
                                        <div class="position-relative">
                                            <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted"><i class="bx bx-package"></i></span>
                                            <input type="number" class="form-control ps-5 @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="Stok produk" value="{{ old('stock', $product->stock) }}">
                                        </div>
                                        @error('stock')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10 d-flex">
                                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-1"><i class="bx bx-save"></i> Update</button>
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
        @if(session('success'))
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
    @endpush
</x-app-layout>
