<x-app-layout>
    @section('title', 'Companies')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Company" :breadcrumb="[
                'Company' => route('companies.index'),
                'Daftar Company' => '',
            ]">

                 <x-ui.button href="{{ route('companies.create') }}" color="primary" icon="plus" permission="companies.create">
                    Tambah Company
                </x-ui.button>
            </x-page-header>

            <x-datatable-card :id="'companies-table'" :ajax="route('companies.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'title' => 'Nama'],
                ['data' => 'acronym', 'title' => 'Acronym'],
                ['data' => 'phone', 'title' => 'Phone'],
                ['data' => 'tax_number', 'title' => 'Tax Number'],
                ['data' => 'status', 'title' => 'Status'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
