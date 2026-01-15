<x-app-layout>
    @section('title', 'Simple Search')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Simple Search" :breadcrumb="[
                'Simple Search' => route('simple-searches.index'),
                'Daftar Data' => '',
            ]">
                <x-ui.button href="{{ route('simple-searches.create') }}" color="primary" icon="plus" permission="simple-searches.create">
                    Tambah Data
                </x-ui.button>
            </x-page-header>

            <x-datatable-card :id="'simple-searches-table'" :ajax="route('simple-searches.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'tanggal', 'title' => 'Tanggal'],
                ['data' => 'pekerjaan', 'title' => 'Pekerjaan'],
                ['data' => 'client', 'title' => 'Client'],
                ['data' => 'nilai', 'title' => 'Nilai', 'className' => 'text-right'],
                ['data' => 'status', 'title' => 'Status'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
