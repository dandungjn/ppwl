<x-app-layout>
    @section('title', 'Order')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Order" :breadcrumb="[
                'Order' => route('orders.index'),
                'Daftar Order' => '',
            ]">
                <x-ui.button href="{{ route('orders.create') }}" color="primary" icon="plus">
                    Tambah Order
                </x-ui.button>
            </x-page-header>
            <x-datatable-card :id="'orders-table'" :ajax="route('orders.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'customer_name', 'title' => 'Customer'],
                ['data' => 'order_items', 'title' => 'Order Details', 'orderable' => false],
                ['data' => 'total_price', 'title' => 'Total', 'format' => 'rupiah'],
                ['data' => 'status', 'title' => 'Status'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
