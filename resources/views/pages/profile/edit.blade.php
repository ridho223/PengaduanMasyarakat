@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')

<style>
    #dropzone .dz-preview .dz-image img {
        max-width: 1000px;
        max-height: 100%;
        object-fit: contain;
    }

    .card-header {
        background: linear-gradient(135deg, #333333, #555555, #ffffff) !important;
    }
</style>
<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card shadow-lg rounded">
                <div class="card-header bg-success text-white text-start">
                    <h3>Edit Profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update', Auth::user()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name Input -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="form-group mb-3">
                            <label for="telephone" class="form-label">No telp</label>
                            <input type="text" id="telephone" name="telephone"
                                class="form-control @error('telephone') is-invalid @enderror"
                                value="{{ old('telephone', $user->telephone) }}">
                            @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Avatar Input -->
                        <div class="form-group mb-3">
                            <label class="form-label">Avatar</label>
                            <div id="dropzone" class="dropzone text-center">
                            </div>
                        </div>

                        <!-- Hidden input for avatar file path -->
                        <input type="hidden" name="old_avatar" id="old_avatar" value="{{ $user->avatar }}">

                        <!-- Password Update Section -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary text-white" id="updatePasswordBtn"
                                onclick="togglePasswordFields()">Perbarui Password</button>
                        </div>

                        <div id="passwordFields" style="display: none;">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password lama</label>
                                <div class="input-group">
                                    <input type="password" class="form-control rounded" name="current_password"
                                        placeholder="Masukkan password lama" value="{{ $user->password }}">
                                    <button type="button" class="btn" style="background: transparent;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control rounded" id="password" name="password"
                                        placeholder="Masukkan password baru">
                                    <button type="button" class="input-group-text" onclick="togglePasswordVisibility()">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control rounded" id="password_confirmation"
                                        name="password_confirmation" placeholder="Konfirmasi password baru">
                                    <button type="button" class="input-group-text" onclick="togglePasswordVisibility()">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>




                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success fw-bold me-2"
                                style="width: 100px;">Simpan</button>
                            <a href="{{ route('admin.profile') }}" class="btn fw-bold"
                                style="width: 100px; background-color:red; color:white;">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dropzone CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />

<!-- Dropzone JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<script>
    function togglePasswordFields() {
        var passwordFields = document.getElementById("passwordFields");
        passwordFields.style.display = (passwordFields.style.display === 'none') ? 'block' : 'none';
    }

    function togglePasswordVisibility() {
        const passwordFields = document.querySelectorAll('#password, #password_confirmation');
        const eyeIcons = document.querySelectorAll('.input-group-text i');

        passwordFields.forEach((passwordField, index) => {
            const eyeIcon = eyeIcons[index];

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    }




    document.querySelector('form').addEventListener('submit', function (event) {
        event.preventDefault();

        if (myDropzone.files.length > 0) {
            myDropzone.processQueue();
        } else {
            this.submit();
        }
    });

    Dropzone.autoDiscover = false;

    const myDropzone = new Dropzone("#dropzone", {
        url: "{{ Auth::user()->status == 'Admin' ? route('admin.profile.upload') : route('user.profile.upload') }}",
        paramName: "file",
        maxFiles: 1,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        dictRemoveFile: "Hapus",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        autoProcessQueue: true,
        success: function (file, response) {
            if (response.success) {
                document.getElementById("old_avatar").value = response.avatar;
            } else {
                alert(response.message);
            }
        },
        error: function (file, response) {
            alert("Gagal mengunggah gambar. Pastikan file memenuhi persyaratan.");
        },
        init: function () {
            let dropzoneInstance = this;
            let oldAvatar = "{{ $user->avatar ? asset('storage/' . $user->avatar) : '' }}";

            if (oldAvatar) {
                let mockFile = { name: "{{ $user->avatar }}", size: 12345, type: 'image/jpeg' };
                dropzoneInstance.emit("addedfile", mockFile);
                dropzoneInstance.emit("thumbnail", mockFile, oldAvatar);
                dropzoneInstance.files.push(mockFile);
            }

            this.on("addedfile", function (file) {
                if (dropzoneInstance.files.length > 1) {
                    dropzoneInstance.removeFile(dropzoneInstance.files[0]);
                }
            });

            this.on("removedfile", function () {
                document.getElementById("old_avatar").value = "";
            });
        }
    });

</script>
@endsection