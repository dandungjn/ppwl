<x-app-layout>
    @section('title', 'Edit Position')
    @section('content')
        <x-page-container>
            <x-page-header title="Edit Position" :breadcrumb="[
                'Position' => route('positions.index'),
                'Edit Position' => '',
            ]" />
            <x-form.card title="Form Edit Position">
                <form action="{{ route('positions.update', $position->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-form.input name="title" label="Title" :value="$position->title" />
                    <x-form.input name="level" label="Level" :value="$position->level" />
                    <x-form.actions cancel="{{ route('positions.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
