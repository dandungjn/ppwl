<x-app-layout>
    @section('title', 'Edit Order Detail')
    @section('content')
        <x-page-container>
            <x-page-header title="Edit Order Detail" :breadcrumb="[
                'Order Detail' => route('order_details.index'),
                'Edit Order Detail' => '',
            ]" />
            <x-form.card title="Form Edit Order Detail">
                <form action="{{ route('order_details.update', $orderDetail->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-form.select name="order_id" label="Order" :options="$orders ?? []" :selected="$orderDetail->order_id" />
                    <x-form.select name="furniture_id" label="Furniture" :options="$furnitures ?? []" :selected="$orderDetail->furniture_id" />
                    <x-form.input name="quantity" label="Quantity" :value="$orderDetail->quantity" />
                    <x-form.input name="price" label="Price" :value="$orderDetail->price" />
                    <x-form.actions cancel="{{ route('order_details.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
