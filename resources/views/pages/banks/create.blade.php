<x-app-layout>
    @section('title', 'Tambah Bank')

    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Bank" :breadcrumb="[
                'Bank' => route('banks.index'),
                'Tambah Bank' => '',
            ]" />

            <x-form.card title="Form Tambah Bank">
                <form action="{{ route('banks.store') }}" method="POST">
                    @csrf
                    <x-form.input name="name" label="Nama Bank" />
                    <x-form.input name="account_number" label="No Rekening" />
                    <x-form.input name="account_holder" label="Nama Pemilik" />
                    <x-form.select name="status" label="Status" :options="[
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
                    ]" />
                    <x-form.actions cancel="{{ route('banks.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
