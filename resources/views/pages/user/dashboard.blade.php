@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    /* Modern black, gray, and white background with a gradient */
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

        25% {
            background: linear-gradient(135deg, #1a73e8, #333333, #4a4a4a);
        }

        50% {
            background: linear-gradient(135deg, #333333, #4a4a4a, #1a73e8);
        }

        100% {
            background: linear-gradient(135deg, #00ff9f, #4a4a4a, #2a2a2a);
        }
    }



    .card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: rgba(255, 255, 255, 0.1);
        /* Slight transparency for a modern feel */
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        border-radius: 12px;
    }

    .card-header {
        border-radius: 12px 12px 0 0;
        background: linear-gradient(135deg, #000000, #555555, #ffffff);
    }

    .table {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        overflow: hidden;
    }

    th,
    td {
        color: #333;
    }

    select,
    input {
        border-radius: 8px;
    }

    canvas {
        background: white;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    #particles-js {
        height: 100vh;
    }

    .btn.back {
        background: linear-gradient(135deg, #000000, #555555, #ffffff);
    }
</style>



<div id="particles-js" class="container-fluid mt-4">
    <!-- Statistics Section -->
    <div class="row g-4">
        @php
            $total = $pengaduanUser->count();
            $pending = $pengaduanUser->where('status', 'Pending')->count();
            $diproses = $pengaduanUser->where('status', 'Diproses')->count();
            $selesai = $pengaduanUser->where('status', 'Selesai')->count();
        @endphp

        @foreach ([['Total Pengaduan', $total, 'primary', 'fa-list'], ['Pending', $pending, 'warning', 'fa-clock'], ['Diproses', $diproses, 'info', 'fa-spinner'], ['Selesai', $selesai, 'success', 'fa-check-circle']] as [$title, $count, $color, $icon])
            <div class="col-md-3">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body text-center bg-{{ $color }} text-white">
                        <i class="fa {{ $icon }} fa-3x mb-3"></i>
                        <h5>{{ $title }}</h5>
                        <h2 class="text-white">{{ $count }}</h2>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Recent Complaints -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-white d-flex justify-content-between">
                    <h5>Pengaduan Saya</h5>
                    <div class="d-flex">
                        <!-- Form untuk Filter Status & Search -->
                        <form method="GET" action="{{ route('user.dashboard') }}" class="d-flex">
                            <select name="status" class="form-control d-inline w-auto bg-secondary text-white me-2"
                                onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses
                                </option>
                                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                                </option>
                            </select>

                            <input type="text" name="search" class="form-control me-2" placeholder="Cari Pengaduan..."
                                value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>

                        <a href="{{ route('user.pengaduan.create') }}" class="btn back btn-success ms-2">
                            <i class="fa fa-plus"></i> Buat Pengaduan Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="pengaduan-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th style="width: 18%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduanUser as $index => $item)
                                <tr data-status="{{ $item->status }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $item->status == 'Pending' ? 'warning' : ($item->status == 'Diproses' ? 'primary' : ($item->status == 'Ditolak' ? 'danger' : 'success')) }} text-white">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('user.pengaduan.show', $item->id) }}"
                                            class="btn btn-outline-dark btn-sm">
                                            <i class="fa fa-eye"></i> Detail
                                        </a>
                                        @if($item->status == 'Pending')
                                            <a href="{{ route('user.pengaduan.edit', $item->id) }}"
                                                class="btn btn-outline-warning btn-sm">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete-btn"
                                                data-id="{{ $item->id }}">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('user.pengaduan.destroy', $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart (can be used for stats) -->
    {{-- <canvas id="pengaduanChart" class="mt-5"></canvas> --}}
</div>


<script>
    $(document).ready(function () {
        // DataTables initialization
        $('#pengaduan-table').DataTable({ responsive: true });

        // Chart.js Pie chart
        var ctx = document.getElementById('pengaduanChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pending', 'Diproses', 'Selesai'],
                datasets: [{
                    data: [{{ $pending }}, {{ $diproses }}, {{ $selesai }}],
                    backgroundColor: ['#ffc107', '#17a2b8', '#28a745']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        });
    });

    // Particles.js for dynamic background
    particlesJS("particles-js", {
        particles: {
            number: { value: 50, density: { enable: true, value_area: 800 } },
            color: { value: "#ffffff" },
            shape: { type: "circle" },
            opacity: { value: 0.5, random: false },
            size: { value: 3, random: true },
            move: { enable: true, speed: 2, direction: "none", random: false }
        },
        interactivity: {
            events: {
                onhover: { enable: true, mode: "repulse" }
            }
        },
        retina_detect: true
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                let itemId = this.getAttribute('data-id');
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#666",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + itemId).submit();
                    }
                });
            });
        });
    });
</script>
@endsection