@extends('layouts.app')
@section('title', 'Tambah Data Masyarakat')

@section('content')
<div class="d-flex justify-content-start ">
    <div class="bg-white p-5 rounded-4 shadow-lg fw-bold" style="width: 1300px;">
        <h3 class="text-center mb-4" style="color: #666;">Tambah Data Masyarakat</h3>
        <form action="{{ route('admin.resident.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="name" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <!-- Nomor Telepon -->
            <div class="mb-3">
                <label for="telephone" class="form-label">Nomor Telepon</label>
                <input type="number" class="form-control" name="telephone" required>
                @error('telephone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col md-6">
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control rounded" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Foto (Avatar) -->
            <!-- Dropzone Area -->
            <div class="form-group mb-3">
                <label class="form-label">Unggah Foto</label>
                <div id="dropzone" class="dropzone text-center"></div>
            </div>

            <!-- Hidden input for avatar file path -->
            <input type="hidden" name="avatar" id="avatar">

            <!-- Tombol Simpan dan Batal -->
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn fw-bold me-2"
                    style="width: 100px; background-color:#776767;color:white;">Simpan</button>
                <a href="{{ route('admin.resident.index') }}" class="btn fw-bold"
                    style="width: 100px; background-color:red; color:white;">Batal</a>
            </div>
        </form>
    </div>
</div>

<!-- Dropzone CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />

<!-- Dropzone JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;

    const myDropzone = new Dropzone("#dropzone", {
        url: "#", // Prevent Dropzone from submitting directly
        maxFiles: 1,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        dictRemoveFile: "Hapus",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        autoProcessQueue: false, // Prevent auto-upload
        init: function () {
            this.on("addedfile", function (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const input = document.createElement('input');
                    input.type = "file";
                    input.name = "avatar";
                    input.style.display = "none";

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    input.files = dataTransfer.files;

                    document.getElementById('dropzone').appendChild(input);
                };
                reader.readAsDataURL(file);
            });

            this.on("removedfile", function () {
                document.querySelector('#dropzone input[name="avatar"]').remove();
            });
        }
    });
</script>
@endsection