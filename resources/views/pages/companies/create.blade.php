<x-app-layout>
    @section('title', 'Tambah Company')

    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Company" :breadcrumb="[
                'Company' => route('companies.index'),
                'Tambah Company' => '',
            ]" />

            <x-form.card title="Form Tambah Company">
                <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-form.input name="name" label="Nama" />
                    <x-form.input name="acronym" label="Acronym" />
                    <x-form.input name="address" label="Alamat" />
                    <x-form.input name="phone" label="Phone" />
                    <x-form.input name="tax_number" label="Tax Number" />
                    <x-form.input name="leader_name" label="Leader Name" />
                    <x-form.select name="bank_id" label="Bank" :options="$banks" />
                    <x-form.input name="tax_status" label="Tax Status" />
                    <x-form.input name="logo_header" label="Logo Header" type="file" />
                    <x-form.input name="logo_stamp" label="Logo Stamp" type="file" />
                    <x-form.input name="logo_signature" label="Logo Signature" type="file" />
                    <x-form.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Tidak Aktif']" />
                    <x-form.actions cancel="{{ route('companies.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
