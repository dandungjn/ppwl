<x-app-layout>
    @section('title', 'Employees')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Employee" :breadcrumb="[
                'Employee' => route('employees.index'),
                'Daftar Employee' => '',
            ]">

                <x-ui.button href="{{ route('employees.create') }}" color="primary" icon="plus" permission="employees.create">
                    Tambah Employee
                </x-ui.button>
            </x-page-header>

            <x-datatable-card :id="'employees-table'" :ajax="route('employees.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'full_name', 'title' => 'Nama'],
                ['data' => 'position', 'title' => 'Posisi'],
                ['data' => 'phone', 'title' => 'Telepon'],
                ['data' => 'email', 'title' => 'Email'],
                ['data' => 'status', 'title' => 'Status'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>
