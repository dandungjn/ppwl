<x-app-layout>
    @section('title', 'Tambah Group')

    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Group" :breadcrumb="[
                'Group' => route('groups.index'),
                'Tambah Group' => '',
            ]" />

            <x-form.card title="Form Tambah Group">
                <form action="{{ route('groups.store') }}" method="POST">
                    @csrf
                    <x-form.input name="name" label="Nama Group" />
                    <x-form.actions cancel="{{ route('groups.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>