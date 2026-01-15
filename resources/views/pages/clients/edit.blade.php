<x-app-layout>
    @section('title', 'Edit Client')

    @section('content')
        <x-page-container>
            <x-page-header title="Edit Client" :breadcrumb="[
                'Client' => route('clients.index'),
                'Edit Client' => '',
            ]" />

            <x-form.card title="Form Edit Client">
                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-form.input name="code" label="Kode" :value="$client->code" readonly />
                    <x-form.input name="name" label="Nama" :value="$client->name" />
                    <x-form.input name="address" label="Alamat" :value="$client->address" />
                    <x-form.input name="npwp" label="NPWP" :value="$client->npwp" />
                    <x-form.input name="pic_name" label="Nama PIC" :value="$client->pic_name" />
                    <x-form.input name="pic_phone" label="Telepon PIC" :value="$client->pic_phone" />
                    <x-form.input name="pic_email" label="Email PIC" :value="$client->pic_email" />
                    <x-form.textarea name="description" label="Deskripsi">{{ $client->description }}</x-form.textarea>
                    <x-form.actions cancel="{{ route('clients.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
