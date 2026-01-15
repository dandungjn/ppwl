<x-app-layout>
    @section('title', 'Tambah Order Detail')
    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Order Detail" :breadcrumb="[
                'Order Detail' => route('order_details.index'),
                'Tambah Order Detail' => '',
            ]" />
            <x-form.card title="Form Tambah Order Detail">
                <form action="{{ route('order_details.store') }}" method="POST">
                    @csrf
                    <x-form.select name="order_id" label="Order" :options="$orders ?? []" />
                    <x-form.select name="furniture_id" label="Furniture" :options="$furnitures ?? []" />
                    <x-form.input name="quantity" label="Quantity" />
                    <x-form.input name="price" label="Price" />
                    <x-form.actions cancel="{{ route('order_details.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
