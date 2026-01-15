<x-app-layout>
    @section('title', 'Tambah Client')

    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Client" :breadcrumb="[
                'Client' => route('clients.index'),
                'Tambah Client' => '',
            ]" />

            <x-form.card title="Form Tambah Client">
                <form action="{{ route('clients.store') }}" method="POST">
                    @csrf
                    <x-form.input name="code" label="Kode" :value="$code ?? old('code')" readonly />
                    <x-form.input name="name" label="Nama" />
                    <x-form.input name="address" label="Alamat" />
                    <x-form.input name="npwp" label="NPWP" />
                    <x-form.input name="pic_name" label="Nama PIC" />
                    <x-form.input name="pic_phone" label="Telepon PIC" />
                    <x-form.input name="pic_email" label="Email PIC" />
                    <x-form.textarea name="description" label="Deskripsi" />
                    <x-form.actions cancel="{{ route('clients.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
