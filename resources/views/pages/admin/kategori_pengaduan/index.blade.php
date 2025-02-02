@extends('layouts.app')
@section('title', 'Kategori Pengaduan')

@section('content')
<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h2 class="m-0 font-weight-bold">Data Kategori Pengaduan</h2>
            <a href="{{ route('admin.kategori_pengaduan.create') }}" class="btn btn-success">Tambah Data</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example" width="100%" collspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align: center;">NO</th>
                            <th>Nama</th>
                            <th style="width: 10%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $row)                     <tr>   
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ $row->nama }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('admin.kategori_pengaduan.edit', $row->id) }}" class="text-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.kategori_pengaduan.destroy', $row->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
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