<x-app-layout>
    @section('title', 'Tambah Category')
    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Category" :breadcrumb="[
                'Category' => route('categories.index'),
                'Tambah Category' => '',
            ]" />
            <x-form.card title="Form Tambah Category">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <x-form.input name="name" label="Nama Category" />
                    <x-form.actions cancel="{{ route('categories.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
