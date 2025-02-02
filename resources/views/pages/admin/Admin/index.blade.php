@extends('layouts.app')
@section('title', 'Data Masyarakat')

@section('content')
<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h2 class="m-0 font-weight-bold">Data Admin</h2>
            <a href="{{ route('admin.Admin.create') }}" class="btn btn-secondary">Tambah Data</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example" width="100%" collspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align: center;">NO</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th style="width: 10%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $user)                        
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->telephone }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('admin.Admin.edit', $user->id) }}" class="text-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.Admin.destroy', $user->id) }}" method="POST"
                                        class="d-inline" id="delete-form-{{$user->id  }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $user->id }})"">
                                                            <i class=" fas fa-trash-alt"></i>
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

<script>
    function confirmDelete(adminId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus permanen.",
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Hapus!',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            reverseButtons: true,
            customClass: {
                title: 'text-dark font-weight-bold',
                content: 'text-secondary',
                popup: 'swal-popup-sm'
            },
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + adminId).submit();
            }
        });
    }
</script>
{{--
<script>
    document.addEventListener('click', function (e) {
        if (e.target.closest('.delete-button')) {
            const button = e.target.closest('.delete-button');
            const formId = button.getAttribute('data-id');
            const form = document.getElementById(`deleteForm-${formId}`);

            Swal.fire({
                title: 'Konfirmasi Penghapusan',
                text: "Apakah Anda yakin ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'swal-custom-pop',
                    title: 'swal-title',
                    confirmButton: 'swal-confirm-button',
                    cancelButton: 'swal-deny-button',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
</script> --}}
@endsection