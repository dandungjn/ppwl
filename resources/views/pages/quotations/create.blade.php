<x-app-layout>
    @section('title', 'Tambah Quotation')

    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Quotation" :breadcrumb="[
                'Quotation' => route('quotations.index'),
                'Tambah Quotation' => '',
            ]" />

            <x-form.card title="Form Tambah Quotation">
                <form action="{{ route('quotations.store') }}" method="POST">
                    @csrf
                    <x-form.input name="number" label="Number" :value="$autoNumber" maxlength="30" readonly />
                    <x-form.input name="subject" label="Subject" :value="old('subject')" maxlength="50" />
                    <x-form.input type="date" name="date" label="Date" :value="old('date')" />
                    <x-form.select name="client_id" label="Client" :options="$clientOptions" :selected="old('client_id')" />
                    <x-form.input name="attention_name" label="Attention Name" :value="old('attention_name')" maxlength="30" />
                    <x-form.textarea name="job_description" label="Job Description" :value="old('job_description')" rows="3" maxlength="225" />
                    <x-form.select name="company_id" label="Company" :options="$companyOptions" :selected="old('company_id')" />
                    <x-form.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Tidak Aktif']" :selected="old('status',1)" />                    
                    <x-quotation-items-table :items="old('items', [])" />
                    <x-form.actions cancel="{{ route('quotations.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>