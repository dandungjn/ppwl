<x-app-layout>
    @section('title', 'User')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar User" :breadcrumb="[
                'User' => route('users.index'),
                'Daftar User' => '',
            ]">
                <x-ui.button href="{{ route('users.create') }}" color="primary" icon="plus" permission="users.create">
                    Tambah User
                </x-ui.button>
            </x-page-header>
            <x-datatable-card :id="'users-table'" :ajax="route('users.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'title' => 'Nama'],
                ['data' => 'email', 'title' => 'Email'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
