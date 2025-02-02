@extends('layouts.app')

@section('content')


<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h2 class="m-0 font-weight-bold">Data Semua Pengaduan</h2>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example" width="100%" collspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align: center;">NO</th>
                            <th>Judul</th>
                            <th>Pengirim</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th style="width: 10%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduans as $pengaduan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengaduan->judul }}</td>
                                <td>{{ $pengaduan->user->name }}</td>
                                <td>{{ $pengaduan->lokasi }}</td>
                                <td>
                                    <span
                                        class="badge badge-{{ $pengaduan->status == 'Pending' ? 'warning' : ($pengaduan->status == 'Diproses' ? 'primary' : ($pengaduan->status == 'Ditolak' ? 'danger' : 'success')) }} text-white">
                                        {{ $pengaduan->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}"
                                        class="btn btn-secondary btn-sm">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection