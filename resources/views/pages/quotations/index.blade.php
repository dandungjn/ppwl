<x-app-layout>
    @section('title', 'Quotation')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-page-header title="Daftar Quotation" :breadcrumb="[
                'Quotation' => route('quotations.index'),
                'Daftar Quotation' => '',
            ]">
                <x-ui.button href="{{ route('quotations.create') }}" color="primary" icon="plus" permission="quotations.create">
                    Tambah Quotation
                </x-ui.button>
            </x-page-header>

            <x-datatable-card :id="'quotations-table'" :ajax="route('quotations.index')" :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'number', 'title' => 'Number'],
                ['data' => 'subject', 'title' => 'Subject'],
                ['data' => 'client', 'title' => 'Client'],
                ['data' => 'attention_name', 'title' => 'Attention'],
                ['data' => 'job_description', 'title' => 'Job Description'],
                ['data' => 'company', 'title' => 'Company'],
                ['data' => 'status', 'title' => 'Status'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ]" :options="null" />
        </div>
    @endsection
</x-app-layout>