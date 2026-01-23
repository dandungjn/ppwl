<x-app-layout>
    @section('title', 'Edit Order')
    @section('content')
        <x-page-container>
            <x-page-header title="Edit Order" :breadcrumb="[
                'Order' => route('orders.index'),
                'Edit Order' => '',
            ]" />
            <x-form.card title="Form Edit Order">
                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="customer_name" label="Customer Name" :value="$order->customer_name" />
                            <x-form.textarea name="customer_address" label="Customer Address" :value="old('customer_address', $order->customer_address)" />
                            <x-form.input name="customer_phone_number" label="Customer Phone" :value="$order->customer_phone_number" />
                        </div>
                        <div class="col-md-6">
                            <x-form.select name="status" label="Status" :options="['pending' => 'Pending', 'paid' => 'Paid', 'cancelled' => 'Cancelled']" :selected="$order->status" />
                            <x-form.input name="total_price" label="Total Price" :value="$order->total_price" readonly />
                        </div>
                    </div>

                    <h5 class="mt-3">Order Details</h5>
                    <div class="d-flex flex-column">
                        <x-order-details.form :furnitures="$furnitures" :details="$order->orderDetails
                            ->map(function ($d) {
                                return [
                                    'furniture_id' => $d->furniture_id,
                                    'quantity' => $d->quantity,
                                    'price' => $d->price,
                                ];
                            })
                            ->toArray()" :furniture-prices="$furniturePrices" />
                    </div>
                    <div class="d-flex justify-content-end">
                        <x-form.actions col="0" cancel="{{ route('orders.index') }}" submitLabel="Update" />
                    </div>
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
