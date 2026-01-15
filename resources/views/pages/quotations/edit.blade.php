
<x-app-layout>
    @section('title', 'Edit Quotation')

    @section('content')
        <x-page-container>
            <x-page-header title="Edit Quotation" :breadcrumb="[
                'Quotation' => route('quotations.index'),
                'Edit Quotation' => '',
            ]" />

            <x-form.card title="Form Edit Quotation">
                <form action="{{ route('quotations.update', $quotation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <x-form.input name="number" label="Number" :value="old('number', $quotation->number)" maxlength="30" />
                    <x-form.input name="subject" label="Subject" :value="old('subject', $quotation->subject)" maxlength="50" />
                    <x-form.input type="date" name="date" label="Date" :value="old('date', optional($quotation->date)->format('Y-m-d'))" />
                    <x-form.select name="client_id" label="Client" :options="$clientOptions" :selected="old('client_id', $quotation->client_id)" />
                    <x-form.input name="attention_name" label="Attention Name" :value="old('attention_name', $quotation->attention_name)" maxlength="30" />
                    <x-form.textarea name="job_description" label="Job Description" :value="old('job_description', $quotation->job_description)" rows="3" maxlength="225" />
                    <x-form.select name="company_id" label="Company" :options="$companyOptions" :selected="old('company_id', $quotation->company_id)" />
                    <x-form.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Tidak Aktif']" :selected="old('status', $quotation->status)" />
                    <x-quotation-items-table :items="old('items', $quotation->items ?? [])" />
                    <x-form.actions cancel="{{ route('quotations.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>