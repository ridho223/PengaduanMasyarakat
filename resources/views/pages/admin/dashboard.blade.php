@extends('layouts.app')

@section('content')
<style>
    .card-header {
        background: linear-gradient(135deg, #333333, #555555, #ffffff);
    }
</style>
<div class="container">
    {{-- <h1 class="display-6 my-3 text-start">Dashboard</h1> --}}

    <!-- Row for Statistics -->
    <div class="row g-4 ">
        <div class="col-md-3">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center bg-primary text-white">
                    <i class="fa fa-list fa-3x mb-3"></i>
                    <h5>Total Pengaduan</h5>
                    <h2 class="text-white">{{ $pengaduan->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center bg-warning text-white">
                    <i class="fa fa-clock fa-3x mb-3"></i>
                    <h5>Pending</h5>
                    <h2 class="text-white">{{ $pengaduan->where('status', 'Pending')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center bg-info text-white">
                    <i class="fa fa-spinner fa-3x mb-3"></i>
                    <h5>Diproses</h5>
                    <h2 class="text-white">{{ $pengaduan->where('status', 'Diproses')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center bg-success text-white">
                    <i class="fa fa-check-circle fa-3x mb-3"></i>
                    <h5>Selesai</h5>
                    <h2 class="text-white">{{ $pengaduan->where('status', 'Selesai')->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Row for Chart and Latest Complaints -->
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h5>Statistik Pengaduan (Bulanan)</h5>
                </div>
                <div class="card-body" style="height: 180px;">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h5>Pengaduan Terbaru</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan->sortByDesc('created_at')->take(4) as $index => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $item->status == 'Pending' ? 'warning' : ($item->status == 'Selesai' ? 'success' : 'info') }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels), // Labels bulan
            datasets: [
                {
                    label: 'Pengaduan',
                    data: @json($data), // Data jumlah pengaduan per bulan
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>

@endsection