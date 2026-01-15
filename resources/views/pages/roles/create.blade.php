<x-app-layout>
    @section('title', 'Tambah Role')
    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Role" :breadcrumb="[
                'Role' => route('roles.index'),
                'Tambah Role' => '',
            ]" />
            <x-form.card title="Form Tambah Role">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <x-form.input name="name" label="Nama Role" />
                  <x-form.checkbox-group
                        name="permissions"
                        :options="$permissions"
                        :selected="[]"
                        label="Permissions"
                        :columns="1"
                    />
                    <x-form.actions :col="12" cancel="{{ route('roles.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
