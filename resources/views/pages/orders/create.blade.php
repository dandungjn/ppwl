<x-app-layout>
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
                    <x-form.input name="customer_name" label="Customer Name" />
                    <x-form.textarea name="customer_address" label="Customer Address" />
                    <x-form.input name="customer_phone_number" label="Customer Phone" />
                    <x-form.input name="total_price" label="Total Price" />
                    <x-form.select name="status" label="Status" :options="[ 'pending' => 'Pending', 'paid' => 'Paid', 'cancelled' => 'Cancelled' ]" />
                    <x-form.actions cancel="{{ route('orders.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
