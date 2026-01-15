<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mb-3">
                <label for="delete_password" class="form-label">Kata Sandi</label>
                <input id="delete_password" name="password" type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" autocomplete="current-password" placeholder="Masukkan kata sandi untuk konfirmasi">
                @error('password', 'userDeletion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex">
                <button type="button" class="btn btn-secondary me-2" x-on:click="$dispatch('close')">Batal</button>
                <button type="submit" class="btn btn-danger d-flex align-items-center gap-1"><i class="bx bx-trash"></i> Hapus Akun</button>
            </div>
        </form>
    </x-modal>
</section>
