@extends('layouts.app')

@section('title', 'Profil Akun')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-5">
            <div class="row">
                <!-- Kolom Kiri: Profil -->
                <div class="col-md-7">
                    <div class="card shadow-lg rounded-lg overflow-hidden">
                        <div class="card-header text-white text-center"
                            style="background: linear-gradient(135deg, #333333, #555555, #ffffff);">
                            <h4 class="my-3">Profil Pengguna</h4>
                        </div>
                        <div class="card-body text-center">
                            <!-- Avatar dengan Efek Hover dan Border Bulat -->
                            <div class="mb-3">
                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?d=mm&s=200' }}"
                                    alt="Avatar" class="border shadow-lg img-fluid"
                                    style="border-radius: 50%; width: 150px; height: 150px; transition: transform .3s; cursor: pointer; border: 4px solid #fff;"
                                    onmouseover="this.style.transform='scale(1.1)'"
                                    onmouseout="this.style.transform='scale(1)'">
                            </div>

                            <!-- User Information -->
                            <h5 class="card-title text-primary">{{ $user->name }}</h5>
                            <p class="text-muted">{{ $user->email }}</p>

                            <!-- Informasi Tambahan -->
                            <div class="mt-3 text-left">
                                <p><strong>📞 Telephone:</strong> {{ $user->telephone ?? 'Tidak ada nomor telepon' }}
                                </p>
                                <p><strong>🛡️ Status:</strong> {{ $user->status ?? 'Belum ditentukan' }}</p>
                                <p><strong>📅 Bergabung Sejak:</strong> {{ $user->created_at->format('d M Y') }}</p>
                            </div>

                            <!-- Edit Profile Button -->
                            <a href="{{ route('admin.profile.edit') }}"
                                class="btn btn-secondary btn-lg rounded-pill shadow-sm mt-3">
                                <i class="fa fa-user-edit"></i> Edit Profil
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Aktivitas & Motivasi -->
                <div class="col-md-5">
                    <!-- Aktivitas Terbaru -->
                    <div class="card shadow-lg">
                        <div class="card-header bg-gradient text-white" style="background: #776767;">
                            <h5>🔍 Aktivitas Terbaru</h5>
                        </div>
                        <div class=" card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-sign-in-alt text-primary me-3"></i>
                                    Terakhir login:
                                    <span class="ms-auto text-muted">
                                        {{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('d M Y H:i') : 'Belum login' }}
                                    </span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-edit text-success me-3"></i>
                                    Perubahan terakhir:
                                    <span class="ms-auto text-muted">
                                        {{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- End Kolom Kanan -->
            </div>
        </div>
    </div>
</div>
@endsection