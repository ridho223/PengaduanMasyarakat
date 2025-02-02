@extends('layouts.app')

@section('content')
<style>
    .container-fluid {
        background: linear-gradient(135deg, #2a2a2a, #4a4a4a, #00ff9f);
        color: rgb(19, 18, 18);
        animation: gradientAnimation 10s ease infinite;
    }

    @keyframes gradientAnimation {
        0% {
            background: linear-gradient(135deg, #2a2a2a, #4a4a4a, #00ff9f);
        }

        50% {
            background: linear-gradient(135deg, #333333, #666666, #1a73e8);
        }

        /* Coral orange */
        100% {
            background: linear-gradient(135deg, #2a2a2a, #4a4a4a, #00ff9f);
        }
    }

    .kartu {
        margin-bottom: 53px;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4 kartu">
            <div class="bg-white p-5 rounded-4 shadow-lg fw-bold">
                <h3 class="text-center mb-4" style="color: #2e2929;">Buat Pengaduan Baru</h3>
                <form action="{{ route('user.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                        @error('judul')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                        @error('deskripsi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                        @error('lokasi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control" required>
                            <option value="" disabled selected class="bg-secondary text-white">Pilih Kategori</option>
                            @foreach($kategori as $kategoris)
                                <option value="{{ $kategoris->id }}">{{ $kategoris->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="lampiran" class="form-label">Lampiran (Opsional)</label>
                            <input type="file" name="lampiran" id="lampiran" class="form-control">
                        </div>
                        @error('lampiran')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-danger fw-bold"
                            style="width: 120px;">Batal</a>
                        <button type="submit" class="btn btn-success fw-bold" style="width: 120px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection