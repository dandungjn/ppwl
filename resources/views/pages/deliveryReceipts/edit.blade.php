<x-app-layout>
    @section('title', 'Edit Delivery Receipt')

    @section('content')
    <x-page-container>
        <x-page-header title="Edit Delivery Receipt" :breadcrumb="[
            'Tanda Terima' => route('delivery-receipts.index'),
            'Edit Delivery Receipt' => '',
        ]" />

        <x-form.card title="Form Edit Delivery Receipt">
            <form action="{{ route('delivery-receipts.update', $receipt->id) }}" method="POST">
                @csrf
                @method('PUT')
                <x-form.select name="company_id" label="Perusahaan" :options="$companies"
                    :selected="old('company_id', $receipt->company_id)" />
                <x-form.input name="receiver_name" label="Penerima" :value="old('receiver_name', $receipt->receiver_name)" maxlength="100" />
                <x-form.input name="sender_name" label="Pengirim" :value="old('sender_name', $receipt->sender_name)" maxlength="100" />
                <x-form.tinymce name="description" label="Description" :value="old('description', $receipt->description)" id="description-edit" rows="6" />
                <x-form.input name="received_date" label="Tanggal" type="date" :value="old('received_date', optional($receipt->received_date)->format('Y-m-d'))" />
                <x-form.select name="status" label="Status" :options="[1=>'Open',2=>'In Transit',3=>'Completed',9=>'Cancelled']" :selected="old('status', $receipt->status)" />
                <x-form.actions cancel="{{ route('delivery-receipts.index') }}" submitLabel="Update" />
            </form>
        </x-form.card>
    </x-page-container>
    @endsection

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ta = document.getElementById('description-edit');
                if (ta) {
                    ta.setAttribute('data-tinymce', '1');
                    ta.setAttribute('data-height', '220');
                    if (window.__initTiny) window.__initTiny('#' + ta.id, 220);
                }
            });
        </script>
    @endpush
</x-app-layout>
