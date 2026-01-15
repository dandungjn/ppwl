<x-app-layout>
    @section('title', 'Blog')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Blog" :breadcrumb="[
                'Blog' => route('blogs.index'),
                'Daftar Blog' => '',
            ]">
                <x-ui.button href="{{ route('blogs.create') }}" color="primary" icon="plus" permission="blogs.create">
                    Tambah Blog
                </x-ui.button>
            </x-page-header>
            <x-datatable-card :id="'blogs-table'" :ajax="route('blogs.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'title', 'title' => 'Judul'],
                ['data' => 'category', 'title' => 'Kategori'],
                ['data' => 'uploaded_by', 'title' => 'Uploader'],
                ['data' => 'status', 'title' => 'Status'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
