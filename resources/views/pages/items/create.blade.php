
<x-app-layout>
    @section('title', 'Tambah Item')

    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Item" :breadcrumb="[
                'Items' => route('items.index'),
                'Tambah Item' => '',
            ]" />

            <x-form.card title="Form Tambah Item">
                <form action="{{ route('items.store') }}" method="POST">
                    @csrf
                    <x-form.input name="type" label="Type" />
                    <x-form.input name="name" label="Name" />
                    <x-form.input name="label" label="Label" />
                    <x-form.actions cancel="{{ route('items.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>