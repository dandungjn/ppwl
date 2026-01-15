<x-app-layout>
    @section('title', 'Position')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Position" :breadcrumb="[
                'Position' => route('positions.index'),
                'Daftar Position' => '',
            ]">
                <x-ui.button href="{{ route('positions.create') }}" color="primary" icon="plus" permission="positions.create">
                    Tambah Position
                </x-ui.button>
            </x-page-header>
            <x-datatable-card :id="'positions-table'" :ajax="route('positions.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'title', 'title' => 'Title'],
                ['data' => 'level', 'title' => 'Level'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
