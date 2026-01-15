<x-app-layout>
    @section('title', 'Role & Permission')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Role" :breadcrumb="[
                'Role' => route('roles.index'),
                'Daftar Role' => '',
            ]">
                <x-ui.button href="{{ route('roles.create') }}" color="primary" icon="plus" permission="roles.create">
                    Tambah Role
                </x-ui.button>
            </x-page-header>
            <x-datatable-card
                :id="'roles-table'"
                :ajax="route('roles.index')"
                :columns="[
                    ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                    ['data' => 'name', 'title' => 'Nama Role'],
                    ['data' => 'permissions', 'title' => 'Permissions', 'orderable' => false, 'searchable' => false, 'defaultContent' => ''],
                    ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'defaultContent' => ''],
                ]"
                :options="null"
            />
        </div>
    @endsection
</x-app-layout>
