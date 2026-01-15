<x-app-layout>
    {{ $errors }}
    @section('title', 'Tambah Order')
    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Order" :breadcrumb="[
                'Order' => route('orders.index'),
                'Tambah Order' => '',
            ]" />
            <x-form.card title="Form Tambah Order">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="customer_name" label="Customer Name" />
                            <x-form.textarea name="customer_address" label="Customer Address" />
                            <x-form.input name="customer_phone_number" label="Customer Phone" />
                        </div>
                        <div class="col-md-6">
                            <x-form.select name="status" label="Status" :options="['pending' => 'Pending', 'paid' => 'Paid', 'cancelled' => 'Cancelled']" />
                            <x-form.input name="total_price" label="Total Price" />
                        </div>
                    </div>

                    <h5 class="mt-3">Order Details</h5>
                    <div class="d-flex flex-column">
                        <x-order-details.form :furnitures="$furnitures" :details="[]" :furniture-prices="$furniturePrices" />
                    </div>
                    <div class="d-flex justify-content-end">
                        <x-form.actions col="0" cancel="{{ route('orders.index') }}" />
                    </div>
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
