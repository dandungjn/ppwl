<x-app-layout>
    @section('title', 'Edit User')
    @section('content')
        <x-page-container>
            <x-page-header title="Edit User" :breadcrumb="[
                'User' => route('users.index'),
                'Edit User' => '',
            ]" />
            <x-form.card title="Form Edit User">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-form.input name="name" label="Nama" :value="$user->name" />
                    <x-form.input name="email" label="Email" type="email" :value="$user->email" />
                    <x-form.select name="role" label="Role" :options="$roles->pluck('name', 'name')->toArray()" :selected="$userRole" />
                    <x-form.input name="password" label="Password (isi jika ingin ganti)" type="password" />
                    <x-form.input name="password_confirmation" label="Konfirmasi Password" type="password" />
                    <x-form.actions cancel="{{ route('users.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
