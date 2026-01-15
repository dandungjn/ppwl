<x-app-layout>
    @section('title', 'Edit Group')

    @section('content')
        <x-page-container>
            <x-page-header title="Edit Group" :breadcrumb="[
                'Group' => route('groups.index'),
                'Edit Group' => '',
            ]" />

            <x-form.card title="Form Edit Group">
                <form action="{{ route('groups.update', $group->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-form.input name="name" label="Nama Group" :value="$group->name" />
                    <x-form.actions cancel="{{ route('groups.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>