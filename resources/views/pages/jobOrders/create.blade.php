<x-app-layout>
    @section('title', 'Tambah Job Order')
    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Job Order" :breadcrumb="[
                'Job Orders' => route('job-orders.index'),
                'Tambah Job Order' => '',
            ]" />

            <x-form.card title="Form Tambah Job Order">
                <form action="{{ route('job-orders.store') }}" method="POST">
                    @csrf
                    <x-form.input name="name" label="Name" />
                    <x-form.input name="spk_number" label="SPK Number" />
                    <x-form.input name="spk_date" label="SPK Date" type="date" />
                    <x-form.input name="contract_value" label="Contract Value" type="number" step="0.01" />
                    <x-form.select name="client_id" label="Client" :options="$clientOptions" />
                    <x-form.select name="quotation_id" label="Quotation" :options="$quotationOptions" />
                    <x-form.input name="payment_method" label="Payment Method" />
                    <x-form.input name="tax_status" label="Tax Status" />
                    <x-form.input name="contract_type" label="Contract Type" />
                    <x-form.input name="start_date" label="Start Date" type="date" />
                    <x-form.input name="end_date" label="End Date" type="date" />
                    <x-form.textarea name="description" label="Description" />
                    <x-form.input name="project_status" label="Project Status" />
                    <x-form.actions cancel="{{ route('job-orders.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
