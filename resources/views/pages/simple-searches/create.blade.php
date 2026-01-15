<x-app-layout>
    @section('title', 'Tambah Simple Search')

    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Data Simple Search" :breadcrumb="[
                'Simple Search' => route('simple-searches.index'),
                'Tambah Data' => '',
            ]" />

            <x-form.card title="Form Tambah Simple Search">
                <form action="{{ route('simple-searches.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="tanggal" label="Tanggal" type="date" />
                        </div>
                        <div class="col-md-6">
                            <x-form.select name="client" label="Client" :options="$clients" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <x-form.textarea name="pekerjaan" label="Pekerjaan" rows="4" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="nilai" label="Nilai" type="number" step="0.01" />
                        </div>
                        <div class="col-md-6">
                            <x-form.select name="status" label="Status" :options="array_combine($statusOptions, $statusOptions)" />
                        </div>
                    </div>

                    <x-form.actions cancel="{{ route('simple-searches.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
