<x-app-layout>
    @section('title', 'Group')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Group" :breadcrumb="[
                'Group' => route('groups.index'),
                'Daftar Group' => '',
            ]">
                <x-ui.button href="{{ route('groups.create') }}" color="primary" icon="plus" permission="groups.create">
                    Tambah Group
                </x-ui.button>
            </x-page-header>

            <x-datatable-card :id="'groups-table'" :ajax="route('groups.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'title' => 'Nama Group'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
