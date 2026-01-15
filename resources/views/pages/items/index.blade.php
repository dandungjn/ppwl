<x-app-layout>
    @section('title', 'Items')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Items" :breadcrumb="[
                'Items' => route('items.index'),
                'Daftar Items' => '',
            ]">
                <x-ui.button href="{{ route('items.create') }}" color="primary" icon="plus" permission="items.create">
                    Tambah Item
                </x-ui.button>
            </x-page-header>

            <x-datatable-card :id="'items-table'" :ajax="route('items.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'type', 'title' => 'Type'],
                ['data' => 'name', 'title' => 'Name'],
                ['data' => 'label', 'title' => 'Label'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>