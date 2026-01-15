<x-app-layout>
    @section('title', 'Edit Employee')

    @section('content')
        <x-page-container>
            <x-page-header title="Edit Employee" :breadcrumb="[
                'Employee' => route('employees.index'),
                'Edit Employee' => '',
            ]" />

            <x-form.card title="Form Edit Employee">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-form.input name="full_name" label="Nama Lengkap" :value="$employee->full_name" />
                    <x-form.input name="birth_place" label="Tempat Lahir" :value="$employee->birth_place" />
                    <x-form.input name="birth_date" label="Tanggal Lahir" type="date" :value="$employee->birth_date" />
                    <x-form.select name="gender" label="Jenis Kelamin" :options="['male' => 'Male', 'female' => 'Female']" :selected="$employee->gender" />
                    <x-form.input name="address" label="Alamat" :value="$employee->address" />
                    <x-form.input name="phone" label="Telepon" :value="$employee->phone" />
                    <x-form.input name="email" label="Email" :value="$employee->email" />
                    <x-form.input name="position" label="Posisi" :value="$employee->position" />
                    <x-form.input name="file_path" label="File" type="file" />
                    @if($employee->file_path)
                        <div class="row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <a href="{{ asset('storage/' . $employee->file_path) }}" target="_blank">Lihat file</a>
                            </div>
                        </div>
                    @endif
                    <x-form.select name="status" label="Status" :options="[1 => 'Aktif', 0 => 'Tidak Aktif']" :selected="$employee->status" />
                    <x-form.actions cancel="{{ route('employees.index') }}" submitLabel="Update" />
                </form>
            </x-form.card>
        </x-page-container>
    @endsection
</x-app-layout>
