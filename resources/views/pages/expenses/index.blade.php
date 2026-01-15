<x-app-layout>
    @section('title', 'Expenses')

    @section('content')
        <x-page-container>
            <x-page-header title="Daftar Expenses" :breadcrumb="[
                'Expenses' => route('expenses.index'),
                'Daftar Expenses' => '',
            ]">
                <x-ui.button href="{{ route('expenses.create') }}" color="primary" icon="plus" permission="expenses.create">
                    Tambah Expense
                </x-ui.button>
            </x-page-header>

            <x-datatable-card :id="'expenses-table'" :ajax="route('expenses.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'number', 'title' => 'Number'],
                ['data' => 'date', 'title' => 'Date'],
                ['data' => 'category', 'title' => 'Category'],
                ['data' => 'description', 'title' => 'Description'],
                ['data' => 'amount', 'title' => 'Amount'],
                ['data' => 'user', 'title' => 'User'],
                ['data' => 'user_modified', 'title' => 'User Modified'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </x-page-container>
    @endsection
</x-app-layout>