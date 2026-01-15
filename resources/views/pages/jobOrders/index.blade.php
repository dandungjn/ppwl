<x-app-layout>
    @section('title', 'Job Orders')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Job Order" :breadcrumb="[
                'Job Orders' => route('job-orders.index'),
                'Daftar Job Order' => '',
            ]">
                <x-ui.button href="{{ route('job-orders.create') }}" color="primary" icon="plus" permission="job-orders.create">
                    Tambah Job Order
                </x-ui.button>
            </x-page-header>
            <x-datatable-card :id="'job-orders-table'" :ajax="route('job-orders.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'spk_number', 'title' => 'SPK Number'],
                ['data' => 'name', 'title' => 'Name'],
                ['data' => 'client_name', 'title' => 'Client'],
                ['data' => 'quotation_attention', 'title' => 'Quotation'],
                ['data' => 'contract_value', 'title' => 'Contract Value'],
                ['data' => 'project_status', 'title' => 'Status'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
