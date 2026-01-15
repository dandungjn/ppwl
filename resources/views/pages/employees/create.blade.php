<x-app-layout>
    @section('title', 'Tambah Employee')

    @section('content')
        <x-page-container>
            <x-page-header title="Tambah Employee" :breadcrumb="[
                'Employee' => route('employees.index'),
                'Tambah Employee' => '',
            ]" />

            <x-form.card title="Form Tambah Employee">
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-form.input name="full_name" label="Nama Lengkap" />
                    <x-form.input name="birth_place" label="Tempat Lahir" />
                    <x-form.input name="birth_date" label="Tanggal Lahir" type="date" />
                    <x-form.select name="gender" label="Jenis Kelamin" :options="['male' => 'Male', 'female' => 'Female']" />
                    <x-form.input name="address" label="Alamat" />
                    <x-form.input name="phone" label="Telepon" />
                    <x-form.input name="email" label="Email" />
                    <x-form.input name="position" label="Posisi" />
                    <x-form.input name="file_path" label="File" type="file" />
                    <x-form.select name="status" label="Status" :options="[1 => 'Active', 0 => 'Inactive']" />
                    <x-form.actions cancel="{{ route('employees.index') }}" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
