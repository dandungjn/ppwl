<x-app-layout>
    @section('title', 'Tambah User')
    @section('content')
        <x-page-container>
            <x-page-header title="Tambah User" :breadcrumb="[
                'User' => route('users.index'),
                'Tambah User' => '',
            ]" />
            <x-form.card title="Form Tambah User">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <x-form.input name="name" label="Nama" />
                    <x-form.input name="email" label="Email" type="email" />
                    <x-form.select name="role" label="Role" :options="$roles->pluck('name', 'name')->toArray()" />
                    <x-form.input name="password" label="Password" type="password" />
                    <x-form.input name="password_confirmation" label="Konfirmasi Password" type="password" />
                    <x-form.actions cancel="{{ route('users.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
