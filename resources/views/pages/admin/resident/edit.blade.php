@extends('layouts.app')
@section('title', 'Edit Data Masyarakat')

@section('content')
<style>
    #dropzone .dz-preview .dz-image img {
        max-width: 1000px;
        max-height: 100%;
        object-fit: contain;
    }
</style>
<div class="d-flex justify-content-start">
    <div class="bg-white p-5 rounded-4 shadow-lg fw-bold" style="width: 1300px;">
        <h3 class="text-center mb-4" style="color: #666;">Edit Data Masyarakat</h3>
        <form action="{{ route('admin.resident.update', $residents->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $residents->name) }}"
                    required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $residents->email) }}"
                    required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-3">
                <label for="telephone" class="form-label">Nomor Telepon</label>
                <input type="number" class="form-control" name="telephone"
                    value="{{ old('telephone', $residents->telephone) }}" required>
                @error('telephone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <!-- Foto (Avatar) -->
            <div class="form-group mb-3">
                <label class="form-label">Avatar</label>
                <div id="dropzone" class="dropzone text-center">
                </div>
            </div>

            <!-- Hidden input for avatar file path -->
            <input type="hidden" name="old_avatar" id="old_avatar" value="{{ $residents->avatar }}">

            <!-- Tombol Simpan dan Batal -->
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn fw-bold me-2"
                    style="width: 100px; background-color:#776767;color:white;">Simpan</button>
                <a href="{{ route('admin.resident.index') }}" class="btn fw-bold"
                    style="width: 100px; background-color:#2A3A1F; color:white;">Batal</a>
            </div>
        </form>
    </div>
</div>

<!-- Dropzone CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />

<!-- Dropzone JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
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
        url: "{{ route('admin.resident.upload', ['id' => $residents->id]) }}",
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
            let oldAvatar = "{{ $residents->avatar ? asset('storage/' . $residents->avatar) : '' }}";

            if (oldAvatar) {
                let mockFile = { name: "{{ $residents->avatar }}", size: 12345, type: 'image/jpeg' };
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