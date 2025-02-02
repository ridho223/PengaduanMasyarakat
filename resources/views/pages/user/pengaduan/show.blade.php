@extends('layouts.app')

@section('content')
<style>
    .container-fluid {
        background: linear-gradient(135deg, #2a2a2a, #4a4a4a, #00ff9f);
        /* Dark gray to vibrant red */
        color: #fff;
        padding-bottom: 50px;
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

    .card-header.back {
        background: linear-gradient(135deg, #000000, #555555, #ffffff);
    }

    .btn {
        background: linear-gradient(135deg, #000000, #555555, #ffffff);
    }
</style>
<div class="container-fluid">
    <div class="container ">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="display-6 text-start mt-4">Detail Pengaduan</h1>
            <a href="{{ route('user.dashboard') }}" class="btn btn-success">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card mb-4 shadow-lg rounded">
            <div class="card-header back bg-success text-white">
                <strong>Judul:</strong> {{ $pengaduan->judul }}
            </div>
            <div class="card-body">
                <p><strong>Deskripsi:</strong> {{ $pengaduan->deskripsi }}</p>
                <p><strong>Alamat:</strong> {{ $pengaduan->lokasi }}</p>
                <p><strong>Kategori Pengaduan:</strong> {{ $kategori->nama }}</p>
                <p><strong>Status:</strong>
                    <span
                        class="badge badge-{{ $pengaduan->status == 'Pending' ? 'warning' : ($pengaduan->status == 'Diproses' ? 'primary' : ($pengaduan->status == 'Ditolak' ? 'danger' : 'success')) }} text-white">
                        {{ $pengaduan->status }}
                    </span>
                </p>

                @if ($pengaduan->lampiran)
                    <div class="mt-3">
                        <strong>Lampiran:</strong>
                        <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" target="_blank"
                            class="btn btn-outline-secondary text-white btn-sm mt-2">
                            <i class="fa fa-file-pdf"></i> Lihat Lampiran
                        </a>
                    </div>
                @else
                    <p class="mt-2"><strong>Lampiran:</strong> Tidak ada</p>
                @endif
            </div>
        </div>

        @if ($pengaduan->tanggapan)
            <div class="card shadow-sm mb-4">
                <div class="card-header back bg-success text-white">
                    <h4 class="m-0">Tanggapan</h4>
                </div>
                <div class="card-body">
                    <p>{{ $pengaduan->tanggapan->tanggapan }}</p>
                    <p class="text-muted">Ditanggapi oleh: <strong>{{ $pengaduan->tanggapan->admin->name }}</strong></p>
                    <p class="text-muted">Tanggal: {{ $pengaduan->tanggapan->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        @else
            <div class="alert alert-warning mt-3 mb-5">
                <strong>Informasi:</strong> Belum ada tanggapan untuk pengaduan ini.
            </div>
        @endif

    </div>
</div>
@endsection