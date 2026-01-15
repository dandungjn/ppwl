<x-app-layout>
    @section('title', 'Bank')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Bank" :breadcrumb="[
                'Bank' => route('banks.index'),
                'Daftar Bank' => '',
            ]">

                <x-ui.button href="{{ route('banks.create') }}" color="primary" icon="plus" permission="banks.create">
                    Tambah Bank
                </x-ui.button>
            </x-page-header>
            <x-datatable-card :id="'banks-table'" :ajax="route('banks.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'title' => 'Nama Bank'],
                ['data' => 'account_number', 'title' => 'No Rekening'],
                ['data' => 'account_holder', 'title' => 'Nama Pemilik'],
                ['data' => 'status', 'title' => 'Status'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
