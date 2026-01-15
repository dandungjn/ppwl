<x-app-layout>
    @section('title', 'Edit Furniture')
    @section('content')
        <x-page-container>
            <x-page-header title="Edit Furniture" :breadcrumb="[
                'Furniture' => route('furniture.index'),
                'Edit Furniture' => '',
            ]" />
            <x-form.card title="Form Edit Furniture">
                <form action="{{ route('furniture.update', $furniture->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-form.select name="category_id" label="Category" :options="$categories ?? []" :selected="$furniture->category_id" />
                    <x-form.input name="name" label="Nama Furniture" :value="$furniture->name" />
                    <x-form.input name="price" label="Price" :value="$furniture->price" />
                    <x-form.input name="image" type="file" label="Image" />
                    <x-ui.current-image :src="$furniture->image" />
                    <x-form.input name="stock" label="Stock" :value="$furniture->stock" />
                    <x-form.textarea name="description" label="Description" :value="$furniture->description" />
                    <x-form.actions cancel="{{ route('furniture.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
