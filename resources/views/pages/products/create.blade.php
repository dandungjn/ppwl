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
                                    <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama produk">
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi produk"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="harga">Harga</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bx bx-money"></i></span>
                                            <input type="number" class="form-control" id="harga" name="harga"
                                                placeholder="Harga produk">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="stok">Stok</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bx bx-package"></i></span>
                                            <input type="number" class="form-control" id="stok" name="stok"
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
</x-app-layout>
