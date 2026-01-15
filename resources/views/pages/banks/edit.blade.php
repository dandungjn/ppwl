<x-app-layout>
    @section('title', 'Edit Bank')

    @section('content')
        <x-page-container>
            <x-page-header title="Edit Bank" :breadcrumb="[
                'Bank' => route('banks.index'),
                'Edit Bank' => '',
            ]" />

            <x-form.card title="Form Edit Bank">
                <form action="{{ route('banks.update', $bank->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-form.input name="name" label="Nama Bank" :value="$bank->name" />
                    <x-form.input name="account_number" label="No Rekening" :value="$bank->account_number" />
                    <x-form.input name="account_holder" label="Nama Pemilik" :value="$bank->account_holder" />
                    <x-form.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Tidak Aktif']" :selected="$bank->status" />
                    <x-form.actions cancel="{{ route('banks.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
