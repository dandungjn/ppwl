<x-app-layout>
    @section('title', 'Edit Role')
    @section('content')
        <x-page-container>
            <x-page-header title="Edit Role" :breadcrumb="[
                'Role' => route('roles.index'),
                'Edit Role' => '',
            ]" />
            <x-form.card title="Form Edit Role">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-form.input name="name" label="Nama Role" :value="$role->name" />
                   <x-form.checkbox-group
                        name="permissions"
                        :options="$permissions"
                        :selected="$role->permissions->pluck('name')->toArray()"
                        label="Permissions"
                        :columns="1"
                    />
                    <x-form.actions :col="12" cancel="{{ route('roles.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
