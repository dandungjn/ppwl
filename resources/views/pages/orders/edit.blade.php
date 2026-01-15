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
                    <x-form.input name="customer_name" label="Customer Name" :value="$order->customer_name" />
                    <x-form.textarea name="customer_address" label="Customer Address">{{ $order->customer_address }}</x-form.textarea>
                    <x-form.input name="customer_phone_number" label="Customer Phone" :value="$order->customer_phone_number" />
                    <x-form.input name="total_price" label="Total Price" :value="$order->total_price" />
                    <x-form.select name="status" label="Status" :options="[ 'pending' => 'Pending', 'paid' => 'Paid', 'cancelled' => 'Cancelled' ]" :selected="$order->status" />
                    <x-form.actions cancel="{{ route('orders.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
