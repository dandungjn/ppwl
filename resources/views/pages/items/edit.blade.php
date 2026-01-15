<x-app-layout>
    @section('title', isset($item) ? 'Edit Item' : 'Tambah Item')

    @section('content')
        <x-page-container>
            <x-page-header title="{{ isset($item) ? 'Edit Item' : 'Tambah Item' }}" :breadcrumb="[
                'Items' => route('items.index'),
                (isset($item) ? 'Edit Item' : 'Tambah Item') => '',
            ]" />

            <x-form.card title="Form {{ isset($item) ? 'Edit' : 'Tambah' }} Item">
                <form action="{{ isset($item) ? route('items.update', $item->id) : route('items.store') }}" method="POST">
                    @csrf
                    @if(isset($item))
                        @method('PUT')
                    @endif

                    <x-form.input name="type" label="Type" :value="old('type', isset($item) ? $item->type : '')" />
                    <x-form.input name="name" label="Name" :value="old('name', isset($item) ? $item->name : '')" />
                    <x-form.input name="label" label="Label" :value="old('label', isset($item) ? $item->label : '')" />

                    <x-form.actions cancel="{{ route('items.index') }}" submitLabel="{{ isset($item) ? 'Update' : 'Simpan' }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>