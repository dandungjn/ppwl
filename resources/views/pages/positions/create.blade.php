<x-app-layout>
    @section('title', 'Tambah Position')
    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Position" :breadcrumb="[
                'Position' => route('positions.index'),
                'Tambah Position' => '',
            ]" />
            <x-form.card title="Form Tambah Position">
                <form action="{{ route('positions.store') }}" method="POST">
                    @csrf
                    <x-form.input name="title" label="Title" />
                    <x-form.input name="level" label="Level" />
                    <x-form.actions cancel="{{ route('positions.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
