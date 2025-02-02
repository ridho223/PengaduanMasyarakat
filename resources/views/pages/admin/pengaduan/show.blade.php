@extends('layouts.app')

@section('content')
<style>
    .modal-header {
        background: linear-gradient(135deg, #555555, #000000, #ffffff);
        color: white;
    }

    .judul {
        background: linear-gradient(135deg, #555555, #000000, #ffffff);
    }
</style>
<div class="container">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="display-6 text-start">Detail Pengaduan</h1>
        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Card for Pengaduan Details -->
    <div class="card shadow-lg mb-4">
        <div class="card-header judul bg-success text-white">
            <p><strong>Judul:</strong> {{ $pengaduan->judul }}</p>
        </div>
        <div class="card-body">
            <p><strong>Deskripsi:</strong> {{ $pengaduan->deskripsi }}</p>
            <p><strong>Alamat:</strong> {{ $pengaduan->lokasi }}</p>
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
                        class="btn btn-outline-secondary btn-sm mt-2 text-white">
                        <i class="fa fa-file-pdf"></i> Lihat Lampiran
                    </a>
                </div>
            @else
                <p class="mt-2"><strong>Lampiran:</strong> Tidak ada</p>
            @endif
        </div>
    </div>

    <!-- Display Tanggapan -->
    @if ($pengaduan->tanggapan)
        <div class="card shadow-lg mb-4">
            <div class="card-header judul bg-success text-white">
                <strong>Tanggapan</strong>
            </div>
            <div class="card-body">
                <p>{{ $pengaduan->tanggapan->tanggapan }}</p>
                <p class="text-muted">
                    Ditanggapi oleh:
                    <strong>{{ $pengaduan->tanggapan->admin->name ?? 'Admin Tidak Diketahui' }}</strong>
                </p>
                <p class="text-muted">
                    Tanggal: {{ $pengaduan->tanggapan->created_at->format('d M Y, H:i') }}
                </p>
                @if ($pengaduan->status == 'Diproses')
                    <div class="d-flex gap-2 mt-3">
                        <form action="{{ route('admin.pengaduan.markAsCompleted', $pengaduan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-secondary">
                                <i class="fa fa-check"></i> Tandai Selesai
                            </button>
                        </form>

                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#rejectModal">
                            <i class="fa fa-times"></i> Tandai Ditolak
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @else
        <!-- Form to Add Tanggapan -->
        <div class="card shadow-lg">
            <div class="card-header judul bg-success text-white">
                <strong>Kirim Tanggapan</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pengaduan.addTanggapan', $pengaduan->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="tanggapan" class="form-control" placeholder="Tulis tanggapan..."
                            required></textarea>
                    </div>
                    <button type="submit" class="btn text-white mt-3">
                        <i class="fa fa-paper-plane"></i> Kirim Tanggapan
                    </button>

                </form>
            </div>
        </div>
    @endif


</div>

<!-- Modal untuk Mengisi Alasan Penolakan -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="rejectForm" action="{{ route('admin.pengaduan.reject', $pengaduan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="reason" class="form-label">Masukkan Alasan Penolakan:</label>
                        <textarea class="form-control" style="border: 1px solid #000000;" id="reason" name="reason"
                            rows="3" required>{{ $pengaduan->tanggapan->reason_reject ?? '' }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-secondary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection