@extends('layouts.app')

@section('content')


<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h2 class="m-0 font-weight-bold ">Rekap Pengaduan</h2>
            <a href="{{ route('admin.rekap.export-pdf') }}" target="_blank" class="btn btn-info text-white">Export
                Pdf</a>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduans as $pengaduan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengaduan->judul }}</td>
                                <td>{{ $pengaduan->user->name }}</td>
                                <td>{{ $pengaduan->lokasi }}</td>
                                <td>{{ $pengaduan->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection