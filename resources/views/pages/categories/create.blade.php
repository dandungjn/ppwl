<x-app-layout>
    @section('title', 'Tambah Kategori')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Tambah Kategori" :breadcrumb="[
                'Kategori' => route('categories.index'),
                'Tambah Kategori' => '',
            ]" />
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Form Tambah Kategori</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label" for="name">Nama Kategori</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama kategori" value="{{ old('name') }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10 d-flex">
                                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-1"><i class="bx bx-save"></i> Simpan</button>
                                        <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">Batal</a>
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
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif
    @endpush
</x-app-layout>
