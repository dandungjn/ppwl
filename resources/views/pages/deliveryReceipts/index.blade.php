<x-app-layout>
    @section('title', 'Tanda Terima')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Tanda Terima" :breadcrumb="[
                'Tanda Terima' => route('delivery-receipts.index'),
                'Daftar Tanda Terima' => '',
            ]">
                <x-ui.button href="{{ route('delivery-receipts.create') }}" color="primary" icon="plus" permission="delivery-receipts.create">
                    Tambah Tanda Terima
                </x-ui.button>
            </x-page-header>

            <x-datatable-card :id="'delivery-receipts-table'" :ajax="route('delivery-receipts.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'receiver_name', 'title' => 'Receiver'],
                ['data' => 'sender_name', 'title' => 'Sender'],
                ['data' => 'status', 'title' => 'Status'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],

            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
