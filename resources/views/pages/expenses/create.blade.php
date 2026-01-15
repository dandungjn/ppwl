<x-app-layout>
    @section('title', 'Tambah Expense')

    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Expense" :breadcrumb="[
                'Expenses' => route('expenses.index'),
                'Tambah Expense' => '',
            ]" />

            <x-form.card title="Form Tambah Expense">
                <form action="{{ route('expenses.store') }}" method="POST">
                    @csrf

                    <x-form.input name="number" label="Number" :value="old('number')" />
                    <x-form.input name="date" label="Date" type="date" :value="old('date')" />
                    <x-form.input name="category" label="Category" type="number" :value="old('category')" />
                    <x-form.textarea name="description" label="Description">{{ old('description') }}</x-form.textarea>
                    <x-form.input name="amount" label="Amount" type="number" step="0.01" :value="old('amount')" />

                    <x-form.actions cancel="{{ route('expenses.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>