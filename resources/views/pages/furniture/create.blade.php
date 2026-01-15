<x-app-layout>
    @section('title', 'Tambah Furniture')
    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Furniture" :breadcrumb="[
                'Furniture' => route('furniture.index'),
                'Tambah Furniture' => '',
            ]" />
            <x-form.card title="Form Tambah Furniture">
                <form action="{{ route('furniture.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-form.select name="category_id" label="Category" :options="$categories ?? []" />
                    <x-form.input name="name" label="Nama Furniture" />
                    <x-form.input name="price" label="Price" />
                    <x-form.input name="image" type="file" label="Image" />
                    <x-form.input name="stock" label="Stock" />
                    <x-form.textarea name="description" label="Description" />
                    <x-form.actions cancel="{{ route('furniture.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
