<x-app-layout>
    @section('title', 'Edit Blog')
    @section('content')
        <x-page-container>
            <x-page-header title="Edit Blog" :breadcrumb="[
                'Blog' => route('blogs.index'),
                'Edit Blog' => '',
            ]" />
            <x-form.card title="Form Edit Blog">
                <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-form.input name="title" label="Judul" :value="$blog->title" />
                    <x-form.input name="category" label="Kategori" :value="$blog->category" />
                    <x-form.textarea name="description" label="Deskripsi" :value="$blog->description" />
                    <x-form.input name="file_path" label="File Gambar" type="file" />
                    @if($blog->file_path)
                        <div class="row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <img src="{{ asset('storage/' . $blog->file_path) }}" alt="preview" style="max-height:80px;">
                            </div>
                        </div>
                    @endif
                    <x-form.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Tidak Aktif']" :selected="$blog->status" />
                    <x-form.actions cancel="{{ route('blogs.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
