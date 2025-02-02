<style>
    /* Topbar Background Gradient */
    .topbar {
        background: linear-gradient(135deg, #333333, #555555, #ffffff);
        color: #fff;
    }

    /* More specific styles for navbar items */
    .navbar .nav-link:hover {
        text-decoration: none;
        background-color: transparent;
        color: #fff !important;
        /* Force white color */
    }

    /* Dropdown menu background */
    .navbar .navbar-nav .dropdown-menu {
        background-color: rgba(30, 30, 30, 0.9) !important;
        border: none;
    }

    /* Dropdown item hover */
    .navbar .navbar-nav .dropdown-menu .dropdown-item:hover {
        background-color: rgba(30, 30, 30, 0.9);
        color: rgb(255, 255, 255) !important;
        /* Force white text */
    }

    /* Avatar border */
    .navbar .nav-link img {
        border: 2px solid #fff;
    }

    /* Dropdown menu on hover */
    .dropdown-menu {
        background-color: rgba(30, 30, 30, 0.9);
        border: none;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #776767 !important;
        color: rgb(255, 255, 255) !important;
    }

    .btn-success {
        background: linear-gradient(135deg, #333333, #555555, #ffffff);
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #ffffff, #555555, #333333, );
    }

    .btn-info {
        background-color: #776767 !important;
        color: #fff !important;
    }

    .modal-header {
        background: linear-gradient(135deg, #333333, #555555, #ffffff);
    }

    #dropzone .dz-preview .dz-image img {
        max-width: 1000px;
        max-height: 100%;
        object-fit: contain;
    }
</style>

<!-- Topbar -->
<nav class="navbar navbar-expand bg-custom-green topbar static-top shadow">

    <h3 class="sidebar-brand-text mx-3 text-white"
        style="color: rgb(22, 20, 20); font-style:italic; text-decoration: none; border: none;">
        Halo Pak</h3>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- User Information -->
        <li class="nav dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-dark small">{{ Auth::user()->email }}</span>
                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?d=mm&s=30' }}"
                    class="rounded-circle" width="30" height="30" alt="User Avatar">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item text-white" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <i class="fas fa-user fa-sm fa-fw mr-2 "></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-white" href="#" onclick="confirmLogout(event)">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- Modal Profile Akun -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-lg overflow-hidden">
            <div class="modal-header text-white text-center"
                style="background: linear-gradient(135deg, #333333, #555555, #ffffff);">
                <h5 class="modal-title w-100" id="profileModalLabel">Profil Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?d=mm&s=200' }}"
                        alt="Avatar" class="border shadow-lg img-fluid"
                        style="border-radius: 50%; width: 150px; height: 150px; transition: transform .3s; cursor: pointer; border: 4px solid #fff; margin-bottom: 20px;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                </div>

                <h5 class="card-title text-dark">{{ $user->name }}</h5>
                <p class="text-muted">{{ $user->email }}</p>

                <div class="mt-3">
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center mb-2">
                            <strong>📞 Telephone:</strong>
                            <span class="ms-3 text-muted">{{ $user->telephone ?? 'Tidak ada nomor telepon' }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <strong>🛡️ Status:</strong>
                            <span class="ms-3 text-muted">{{ $user->status ?? 'Belum ditentukan' }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <strong>📅 Bergabung Sejak:</strong>
                            <span class="ms-3 text-muted">{{ $user->created_at->format('d M Y') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-sign-in-alt text-primary me-3"></i>
                            <strong>Terakhir login:</strong>
                            <span class="ms-3 text-muted">
                                {{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('d M Y H:i') : 'Belum login' }}
                            </span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-edit text-success me-3"></i>
                            <strong>Perubahan terakhir:</strong>
                            <span class="ms-3 text-muted">
                                {{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}
                            </span>
                        </li>
                    </ul>
                </div>


                <a href="javascript:void(0)" class="btn btn-secondary btn-lg rounded-pill shadow-sm mt-3"
                    data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="fa fa-user-edit"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Modal edit form --}}
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="openProfileModal()"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.profile.update', Auth::user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telephone" class="form-label">No Telp</label>
                        <input type="text" id="telephone" name="telephone"
                            class="form-control @error('telephone') is-invalid @enderror"
                            value="{{ old('telephone', $user->telephone) }}">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Avatar</label>
                        <div id="dropzone" class="dropzone text-center">
                        </div>
                    </div>

                    <input type="hidden" name="old_avatar" id="old_avatar" value="{{ $user->avatar }}">

                    <div class="mb-3">
                        <button type="button" class="btn btn-success text-white" id="updatePasswordBtn"
                            onclick="togglePasswordFields()">Perbarui Password</button>
                    </div>

                    <div id="passwordFields" style="display: none;">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password lama</label>
                            <div class="input-group">
                                <input type="password" class="form-control rounded" name="current_password"
                                    placeholder="Masukkan password lama" value="{{ $user->password }}">
                                <button type="button" class="btn" style="background: transparent;">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control rounded" id="password" name="password"
                                    placeholder="Masukkan password baru">
                                <button type="button" class="input-group-text" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control rounded" id="password_confirmation"
                                    name="password_confirmation" placeholder="Konfirmasi password baru">
                                <button type="button" class="input-group-text" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-secondary fw-bold me-2">Simpan</button>
                        <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Dropzone CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />

<!-- Dropzone JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<script>
    function togglePasswordFields() {
        var passwordFields = document.getElementById("passwordFields");
        passwordFields.style.display = (passwordFields.style.display === 'none') ? 'block' : 'none';
    }
    function togglePasswordVisibility() {
        const passwordFields = document.querySelectorAll('#password, #password_confirmation');
        const eyeIcons = document.querySelectorAll('.input-group-text i');

        passwordFields.forEach((passwordField, index) => {
            const eyeIcon = eyeIcons[index];

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    }


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
        url: "{{ Auth::user()->status == 'Admin' ? route('admin.profile.upload') : route('user.profile.upload') }}",
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
            let oldAvatar = "{{ $user->avatar ? asset('storage/' . $user->avatar) : '' }}";

            if (oldAvatar) {
                let mockFile = { name: "{{ $user->avatar }}", size: 12345, type: 'image/jpeg' };
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
    function openProfileModal() {
        $('#editProfileModal').modal('hide');

        $('#profileModal').modal('show');
    }

    document.querySelector('.btn-close').addEventListener('click', function () {
        openProfileModal();
    });
</script>


<script>
    function confirmLogout(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Keluar dari Aplikasi?',
            text: "Apakah Anda yakin ingin keluar?",
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Keluar',
            confirmButtonColor: '#776767',
            cancelButtonColor: '#d33',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit(); // Kirim form logout
            }
        });
    }
</script>

{{--
<script>
    document.getElementById('logoutLink').addEventListener('click', function (event) {
        event.preventDefault();
        Swal.fire({
            title: `
        Apakah Anda yakin ingin keluar?
        <small class="text-muted">klik keluar untuk logout !</small>
    `,
            customClass: {
                icon: 'swal-custom-icon',
                popup: 'swal-custom-pop',
                title: 'swal-title',
                confirmButton: 'swal-confirm-button',
                denyButton: 'swal-deny-button',
            },
            showCancelButton: true,
            confirmButtonText: '<i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar',
            cancelButtonText: '<i class="fas fa-times"></i> Batal',
            confirmButtonColor: '#FDD97C',
            cancelButtonColor: 'black'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('logout') }}";
            }
        });
    });
</script> --}}
<!-- End of Topbar -->