<x-app-layout>
    @section('title', 'Edit Expense')

    @section('content')
        <x-page-container>
            <x-page-header title="Edit Expense" :breadcrumb="[
                'Expenses' => route('expenses.index'),
                'Edit Expense' => '',
            ]" />

            <x-form.card title="Form Edit Expense">
                <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <x-form.input name="number" label="Number" :value="old('number', $expense->number)" />
                    <x-form.input name="date" label="Date" type="date" :value="old('date', optional($expense->date)->format('Y-m-d'))" />
                    <x-form.input name="category" label="Category" type="number" :value="old('category', $expense->category)" />
                    <x-form.textarea name="description" label="Description">{{ old('description', $expense->description) }}</x-form.textarea>
                    <x-form.input name="amount" label="Amount" type="number" step="0.01" :value="old('amount', $expense->amount)" />

                    <x-form.actions cancel="{{ route('expenses.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>