<x-app-layout>
    @section('title', 'Order Detail')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Order Detail" :breadcrumb="[
                'Order Detail' => route('order_details.index'),
                'Daftar Order Detail' => '',
            ]">
                <x-ui.button href="{{ route('order_details.create') }}" color="primary" icon="plus" permission="order_details.create">
                    Tambah Order Detail
                </x-ui.button>
            </x-page-header>
            <x-datatable-card :id="'order_details-table'" :ajax="route('order_details.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'order_id', 'title' => 'Order'],
                ['data' => 'furniture_id', 'title' => 'Furniture'],
                ['data' => 'quantity', 'title' => 'Quantity'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
