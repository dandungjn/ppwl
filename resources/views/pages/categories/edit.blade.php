<x-app-layout>
    @section('title', 'Edit Category')
    @section('content')
        <x-page-container>
            <x-page-header title="Edit Category" :breadcrumb="[
                'Category' => route('categories.index'),
                'Edit Category' => '',
            ]" />
            <x-form.card title="Form Edit Category">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-form.input name="name" label="Nama Category" :value="$category->name" />
                    <x-form.actions cancel="{{ route('categories.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
