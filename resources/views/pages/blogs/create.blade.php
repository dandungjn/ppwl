<x-app-layout>
    @section('title', 'Tambah Blog')
    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Blog" :breadcrumb="[
                'Blog' => route('blogs.index'),
                'Tambah Blog' => '',
            ]" />
            <x-form.card title="Form Tambah Blog">
                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-form.input name="title" label="Judul" />
                    <x-form.input name="category" label="Kategori" />
                    <x-form.textarea name="description" label="Deskripsi" />
                    <x-form.input name="file_path" label="File Gambar" type="file" />
                    <x-form.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Tidak Aktif']" />
                    <x-form.actions cancel="{{ route('blogs.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
