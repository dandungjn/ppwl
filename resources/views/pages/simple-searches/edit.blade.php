<x-app-layout>
    @section('title', 'Edit Simple Search')

    @section('content')
        <x-page-container>
            <x-page-header title="Edit Data Simple Search" :breadcrumb="[
                'Simple Search' => route('simple-searches.index'),
                'Edit Data' => '',
            ]" />

            <x-form.card title="Form Edit Simple Search">
                <form action="{{ route('simple-searches.update', $simpleSearch->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="tanggal" label="Tanggal" type="date" :value="$simpleSearch->tanggal->format('Y-m-d')" />
                        </div>
                        <div class="col-md-6">
                            <x-form.select name="client" label="Client" :options="$clients" :value="$simpleSearch->client" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <x-form.textarea name="pekerjaan" label="Pekerjaan" rows="4" :value="$simpleSearch->pekerjaan" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="nilai" label="Nilai" type="number" step="0.01" :value="$simpleSearch->nilai" />
                        </div>
                        <div class="col-md-6">
                            <x-form.select name="status" label="Status" :options="array_combine($statusOptions, $statusOptions)" :value="$simpleSearch->status" />
                        </div>
                    </div>

                    <x-form.actions cancel="{{ route('simple-searches.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
