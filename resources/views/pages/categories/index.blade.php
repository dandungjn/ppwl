<x-app-layout>
    @section('title', 'Category')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Category" :breadcrumb="[
                'Category' => route('categories.index'),
                'Daftar Category' => '',
            ]">
                <x-ui.button href="{{ route('categories.create') }}" color="primary" icon="plus" permission="categories.create">
                    Tambah Category
                </x-ui.button>
            </x-page-header>
            <x-datatable-card :id="'categories-table'" :ajax="route('categories.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'title' => 'Nama Category'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
