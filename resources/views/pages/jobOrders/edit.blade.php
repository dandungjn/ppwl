<x-app-layout>
    @section('title', 'Edit Job Order')
    @section('content')
        <x-page-container>
            <x-page-header title="Edit Job Order" :breadcrumb="[
                'Job Orders' => route('job-orders.index'),
                'Edit Job Order' => '',
            ]" />

            <x-form.card title="Form Edit Job Order">
                <form action="{{ route('job-orders.update', $jobOrder->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-form.input name="name" label="Name" :value="$jobOrder->name" />
                    <x-form.input name="spk_number" label="SPK Number" :value="$jobOrder->spk_number" />
                    <x-form.input name="spk_date" label="SPK Date" type="date" :value="$jobOrder->spk_date" />
                    <x-form.input name="contract_value" label="Contract Value" type="number" step="0.01":value="$jobOrder->contract_value" />
                    <x-form.select name="client_id" label="Client" :options="$clientOptions" :selected="old('client_id', $jobOrder->client_id)" />
                    <x-form.select name="quotation_id" label="Quotation" :options="$quotationOptions" :selected="old('quotation_id', $jobOrder->quotation_id)" />
                    <x-form.input name="payment_method" label="Payment Method" :value="$jobOrder->payment_method" />
                    <x-form.input name="tax_status" label="Tax Status" :value="$jobOrder->tax_status" />
                    <x-form.input name="contract_type" label="Contract Type" :value="$jobOrder->contract_type" />
                    <x-form.input name="start_date" label="Start Date" type="date" :value="$jobOrder->start_date" />
                    <x-form.input name="end_date" label="End Date" type="date" :value="$jobOrder->end_date" />
                    <x-form.textarea name="description" label="Description">{{ $jobOrder->description }}</x-form.textarea>
                    <x-form.input name="project_status" label="Project Status" :value="$jobOrder->project_status" />
                    <x-form.actions cancel="{{ route('job-orders.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
