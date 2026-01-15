<x-app-layout>
    @section('title', 'Furniture')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Furniture" :breadcrumb="[
                'Furniture' => route('furniture.index'),
                'Daftar Furniture' => '',
            ]">
                <x-ui.button href="{{ route('furniture.create') }}" color="primary" icon="plus"
                    permission="furniture.create">
                    Tambah Furniture
                </x-ui.button>
            </x-page-header>
            <x-datatable-card :id="'furnitures-table'" :ajax="route('furniture.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'title' => 'Nama Furniture'],
                ['data' => 'price', 'title' => 'Price', 'format' => 'rupiah'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
