@extends('layouts.app')

@section('title', 'Create Kategori Pengaduan')

@section('content')
<div class="d-flex justify-content-start ">
    <div class="bg-white p-5 rounded-4 shadow-lg fw-bold" style="width: 1300px;">
        <h3 class="text-center mb-4" style="color: #666;">Tambah Data Kategori Pengaduan</h3>
        <form action="{{ route('admin.kategori_pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama -->
            <div class="mb-3 col-md-10">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Simpan dan Batal -->
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-success fw-bold me-2"
                    style="width: 100px; color: #776767;color:white; ">Simpan</button>
                <a href="{{ route('admin.resident.index') }}" class="btn fw-bold"
                    style="width: 100px; background-color:red; color:white;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection