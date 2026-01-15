<x-app-layout>
    @section('title', 'Edit Company')

    @section('content')
        <x-page-container>
            <x-page-header title="Edit Company" :breadcrumb="[
                'Company' => route('companies.index'),
                'Edit Company' => '',
            ]" />

            <x-form.card title="Form Edit Company">
                <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-form.input name="name" label="Nama" :value="$company->name" />
                    <x-form.input name="acronym" label="Acronym" :value="$company->acronym" />
                    <x-form.input name="address" label="Alamat" :value="$company->address" />
                    <x-form.input name="phone" label="Phone" :value="$company->phone" />
                    <x-form.input name="tax_number" label="Tax Number" :value="$company->tax_number" />
                    <x-form.input name="leader_name" label="Leader Name" :value="$company->leader_name" />
                    <x-form.select name="bank_id" label="Bank" :options="$banks" :selected="$company->bank_id" />
                    <x-form.input name="tax_status" label="Tax Status" :value="$company->tax_status" />
                    <x-form.input name="logo_header" label="Logo Header" type="file" />
                    @if($company->logo_header)
                        <div class="row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <img src="{{ asset('storage/' . $company->logo_header) }}" alt="logo header" style="max-height:80px;">
                            </div>
                        </div>
                    @endif
                    <x-form.input name="logo_stamp" label="Logo Stamp" type="file" />
                    @if($company->logo_stamp)
                        <div class="row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <img src="{{ asset('storage/' . $company->logo_stamp) }}" alt="logo stamp" style="max-height:80px;">
                            </div>
                        </div>
                    @endif
                    <x-form.input name="logo_signature" label="Logo Signature" type="file" />
                    @if($company->logo_signature)
                        <div class="row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <img src="{{ asset('storage/' . $company->logo_signature) }}" alt="logo signature" style="max-height:80px;">
                            </div>
                        </div>
                    @endif
                    <x-form.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Tidak Aktif']" :selected="$company->status" />
                    <x-form.actions cancel="{{ route('companies.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
