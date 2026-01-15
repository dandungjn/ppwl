<x-app-layout>
    @section('title', 'Edit Profil')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Ubah Informasi Profil</h5>
                        </div>
                        <div class="card-body">
                            @include('pages.profile.partials.update-profile-information-form')
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Ubah Kata Sandi</h5>
                        </div>
                        <div class="card-body">
                            @include('pages.profile.partials.update-password-form')
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Hapus Akun</h5>
                        </div>
                        <div class="card-body">
                            @include('pages.profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
