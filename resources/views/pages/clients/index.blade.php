<x-app-layout>
    @section('title', 'Clients')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Client" :breadcrumb="[
                'Client' => route('clients.index'),
                'Daftar Client' => '',
            ]">

                <x-ui.button href="{{ route('clients.create') }}" color="primary" icon="plus" permission="clients.create">
                    Tambah Client
                </x-ui.button>
            </x-page-header>

            <x-datatable-card :id="'clients-table'" :ajax="route('clients.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'title' => 'Nama'],
                ['data' => 'address', 'title' => 'Alamat'],
                ['data' => 'npwp', 'title' => 'NPWP'],
                ['data' => 'pic_name', 'title' => 'PIC'],
                ['data' => 'pic_phone', 'title' => 'Telepon PIC'],
                ['data' => 'pic_email', 'title' => 'Email PIC'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
