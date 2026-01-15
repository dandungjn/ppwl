<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form id="profile-form" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email"
                class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}"
                required autocomplete="username">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Profil</label>

            @if ($user->profile_photo)
                <div class="mb-2">
                    <img id="current-profile" src="{{ asset('storage/' . $user->profile_photo) }}" alt="profile"
                        class="avatar-circle" style="width:120px;height:120px;" />
                </div>
            @endif

            <!-- Dropzone area -->
            <div id="profile-dropzone" class="dropzone mb-2" style="border:2px dashed #e2e2e8;padding:20px;">
                <div class="dz-message">Tarik & lepas gambar di sini, atau klik untuk memilih.</div>
            </div>

            <!-- Hidden fallback file input -->
            <input id="photo" name="photo" type="file" accept="image/*"
                class="form-control d-none @error('photo') is-invalid @enderror">
            <input id="photo_base64" name="photo_base64" type="hidden" />
            @error('photo')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <!-- Preview for cropped image -->
            <div id="cropped-preview" class="mt-2" style="display:none;">
                <label class="form-label">Preview hasil crop</label>
                <div>
                    <img id="cropped-image" src="#" alt="cropped" class="avatar-circle" style="width:160px;height:160px;" />
                </div>
            </div>

            <!-- Crop container -->
            <div id="crop-container" style="display:none;margin-top:10px;">
                <div>
                    <img id="crop-image" src="#" alt="To crop" style="max-width:50%;" />
                </div>
                <div class="mt-2 d-flex justify-content-end gap-2">
                    <x-ui.button id="btn-crop" color="primary">Crop & Gunakan</x-ui.button>
                    <x-ui.button id="btn-cancel-crop" color="secondary">Batal</x-ui.button>
                </div>
            </div>
        </div>

        <x-ui.button type="submit" id="btn-save-profile" class="btn btn-primary d-flex align-items-center gap-1">
            <i class="bx bx-save"></i> Simpan Perubahan
        </x-ui.button>
    </form>

    @push('scripts')
        <script>
            (function($) {

                Dropzone.autoDiscover = false;

                let cropper = null;
                let isCropAction = false;

                // Fungsi untuk reset semua state
                function resetUploadState() {
                    // Destroy cropper
                    if (cropper) {
                        cropper.destroy();
                        cropper = null;
                    }

                    // Hide containers
                    $('#crop-container').hide();
                    $('#cropped-preview').hide();

                    // Clear values
                    $('#photo_base64').val('');
                    $('#photo').val('');

                    // Reset crop image source
                    $('#crop-image').attr('src', '#');
                    $('#cropped-image').attr('src', '#');

                    // Remove all files from dropzone
                    if (dz.files.length > 0) {
                        dz.removeAllFiles(true);
                    }
                }

                const dz = new Dropzone('#profile-dropzone', {
                    url: '#',
                    autoProcessQueue: false,
                    maxFiles: 1,
                    acceptedFiles: 'image/*',
                    clickable: true,
                    addRemoveLinks: true,
                    dictRemoveFile: "Hapus",
                    dictMaxFilesExceeded: "Anda hanya dapat mengunggah 1 file",
                    dictInvalidFileType: "Tipe file tidak valid. Hanya gambar yang diperbolehkan.",
                    init: function() {
                        this.on('addedfile', function(file) {
                            // Validasi: jika sudah ada file, hapus file yang baru ditambahkan
                            if (this.files.length > 1) {
                                this.removeFile(file);
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({ icon: 'error', title: 'Batas file', text: 'Anda hanya dapat mengunggah 1 file. Hapus file sebelumnya terlebih dahulu.' });
                                } else {
                                    alert('Anda hanya dapat mengunggah 1 file. Hapus file sebelumnya terlebih dahulu.');
                                }
                                return;
                            }

                            const url = URL.createObjectURL(file);
                            $('#crop-image').attr('src', url);
                            $('#crop-container').show();
                            $('#cropped-preview').hide();
                            // disable save button while user is cropping
                            $('#btn-save-profile').prop('disabled', true);

                            if (cropper) cropper.destroy();

                            // avoid attaching multiple load handlers
                            $('#crop-image').off('load').on('load', function() {
                                cropper = new Cropper(document.getElementById('crop-image'), {
                                    aspectRatio: 1,
                                    viewMode: 1,
                                    autoCropArea: 1,
                                });
                            });
                        });

                        this.on('removedfile', function() {
                            // Jangan reset jika sedang dalam proses crop
                            if (isCropAction) return;

                            // Reset state hanya jika tidak ada file tersisa
                                if (this.files.length === 0) {
                                if (cropper) {
                                    cropper.destroy();
                                    cropper = null;
                                }

                                $('#crop-container').hide();
                                $('#cropped-preview').hide();
                                $('#photo_base64').val('');
                                $('#photo').val('');
                                    // enable save button if no cropping in progress
                                    $('#btn-save-profile').prop('disabled', false);
                            }
                        });

                        this.on('maxfilesexceeded', function(file) {
                            this.removeFile(file);
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({ icon: 'error', title: 'Batas file', text: 'Anda hanya dapat mengunggah 1 file.' });
                            }
                        });
                    }
                });

                // Tombol Batal - Reset semua
                $('#btn-cancel-crop').on('click', function() {
                    isCropAction = false;
                    resetUploadState();
                    // ensure save button is enabled after cancelling crop
                    $('#btn-save-profile').prop('disabled', false);
                });

                // Tombol Crop
                $('#btn-crop').on('click', function() {
                    if (!cropper) return;

                    const canvas = cropper.getCroppedCanvas({
                        width: 600,
                        height: 600,
                        fillColor: "#fff"
                    });

                        canvas.toBlob(function(blob) {
                        const file = new File([blob], "profile.jpg", {
                            type: "image/jpeg"
                        });

                        const dt = new DataTransfer();
                        dt.items.add(file);
                        const inputEl = document.getElementById('photo');
                        inputEl.files = dt.files;
                        // trigger change so any listeners react to new file
                        $(inputEl).trigger('change');

                        const previewUrl = URL.createObjectURL(blob);
                        $("#cropped-image").attr("src", previewUrl);
                        $("#cropped-preview").show();

                        const reader = new FileReader();
                        reader.onloadend = function() {
                            $('#photo_base64').val(reader.result);
                        };
                        reader.readAsDataURL(blob);

                        // Tandai bahwa ini adalah aksi crop
                        isCropAction = true;
                        dz.removeAllFiles(true);
                        isCropAction = false;

                        // Destroy cropper dan hide container
                        if (cropper) {
                            cropper.destroy();
                            cropper = null;
                        }
                        $('#crop-container').hide();
                        // re-enable save button now that cropping is finished
                        $('#btn-save-profile').prop('disabled', false);

                    }, "image/jpeg", 0.85);
                });

                // Form submit: ensure single file and if user didn't click crop but has file in Dropzone,
                // attach that file to the hidden input so normal form submit sends it.
                $('#profile-form').on('submit', function(e){
                    const form = this;
                    const input = document.getElementById('photo');

                    // If native input has more than one file (defensive), block
                    if (input && input.files && input.files.length > 1) {
                        e.preventDefault();
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({ icon: 'error', title: 'Kesalahan', text: 'Hanya boleh mengunggah 1 file.' });
                        } else {
                            alert('Hanya boleh mengunggah 1 file.');
                        }
                        return false;
                    }

                    // If no file set on native input but Dropzone has a file, attach it now
                    if (( !input || !input.files || input.files.length === 0 ) && dz && dz.files && dz.files.length > 0) {
                        const dzFile = dz.files[0];
                        try {
                            // dzFile should be a File-like object
                            const dt = new DataTransfer();
                            dt.items.add(dzFile);
                            if (input) input.files = dt.files;
                        } catch (err) {
                            // fallback: set base64 from the file
                            try {
                                const reader = new FileReader();
                                reader.onloadend = function() {
                                    $('#photo_base64').val(reader.result);
                                    // now submit form
                                    form.submit();
                                };
                                reader.readAsDataURL(dzFile);
                                e.preventDefault(); // will submit in reader.onloadend
                                return false;
                            } catch (e) {
                                // give up and allow submit (server will handle)
                            }
                        }
                    }

                    // allow normal submit
                    return true;
                });

            })(jQuery);
        </script>
    @endpush
</section>
