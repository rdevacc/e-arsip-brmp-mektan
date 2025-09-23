@extends('layouts.app')

@section('title')
    Monitoring Pengunjung Arsip | E-Arsip BRMP Mektan
@endsection

@section('content')
<main id="main" class="main">
    <section class="section quantity-unit">
        <div class="pagetitle">
            <h1>Monitoring Pengunjung</h1>
        </div>

        <!-- Session Alert -->
        @if (session('success'))
            <div class="alert alert-primary d-flex align-items-center justify-content-between" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Statistik Pengunjung -->
        <div class="row mt-4 g-3">
            <!-- Total Pengunjung -->
            <div class="col-12 col-lg-3">
                <div class="card info-card shadow-sm border-0 p-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Pengunjung</h5>
                        <h2 id="total-visitors" class="fw-bold text-primary mb-0">0</h2>
                    </div>
                </div>
            </div>

            <!-- Pengunjung Hari Ini -->
            <div class="col-12 col-lg-3">
                <div class="card info-card shadow-sm border-0 p-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pengunjung Hari Ini</h5>
                        <h2 id="today-visitors" class="fw-bold text-success mb-0">0</h2>
                    </div>
                </div>
            </div>

            <!-- Statistik Mingguan -->
            <div class="col-12 col-lg-3 mt-3">
                <div class="card info-card shadow-sm border-0 p-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pengunjung Minggu Ini</h5>
                        <h2 id="weekly-visitors" class="fw-bold text-warning mb-0">0</h2>
                    </div>
                </div>
            </div>

            <!-- Statistik Bulanan -->
            <div class="col-12 col-lg-3 mt-3">
                <div class="card info-card shadow-sm border-0 p-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pengunjung Bulan Ini</h5>
                        <h2 id="monthly-visitors" class="fw-bold text-danger mb-0">0</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pengunjung Terbaru -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body">
                <h5 class="card-title">Pengunjung Terbaru</h5>
                <div class="table-responsive">
                    <table id="latest-visitors-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>IP Address</th>
                                <th>Browser</th>
                                <th>Device</th>
                                <th>Waktu Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>
            </div>
        </div>

        <!-- Grafik Pengunjung -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body">
                <h5 class="card-title">Statistik Pengunjung 7 Hari Terakhir</h5>
                <canvas id="visitors-chart" height="120"></canvas>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // === Tracking otomatis setiap user akses halaman ===
    $.ajax({
        url: "{{ route('visitor.track') }}",
        type: "POST",
        data: {_token: "{{ csrf_token() }}"},
        success: function(res) {
            console.log(res.status); // tracked
        },
        error: function(err) {
            console.error(err);
        }
    });$.ajax({
        url: "{{ route('visitor.track') }}",
        type: "POST",
        data: {_token: "{{ csrf_token() }}"},
        success: function(res) {
            console.log(res.status); // tracked
        },
        error: function(err) {
            console.error(err);
        }
    });

    // === Fungsi ambil data pengunjung ===
    function loadVisitors() {
        $.get("{{ route('visitor.count') }}", function(data) {
            $('#total-visitors').text(data.total);
        });

        $.get("{{ route('visitor.today') }}", function(data) {
            $('#today-visitors').text(data.today);
        });

        $.get("{{ route('visitor.weekly') }}", function(data) {
            $('#weekly-visitors').text(data.weekly);
        });

        $.get("{{ route('visitor.monthly') }}", function(data) {
            $('#monthly-visitors').text(data.monthly);
        });
    }

    // === Load tabel pengunjung terbaru ===
    $('#latest-visitors-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('visitor.latest') }}",
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'name', name: 'name' },
        { data: 'ip', name: 'ip' },
        { data: 'browser', name: 'browser' },
        { data: 'device', name: 'device' },
        { data: 'created_at', name: 'created_at' },
    ],
    order: [[5, 'desc']],
    pageLength: 10
});


    // === Load grafik pengunjung 7 hari terakhir ===
    function loadVisitorChart() {
        $.get("{{ route('visitor.chart') }}", function(response) {
            const ctx = document.getElementById('visitors-chart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: response.labels,
                    datasets: [{
                        label: 'Pengunjung',
                        data: response.data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true },
                        tooltip: { mode: 'index', intersect: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        });
    }

    // Panggil semua fungsi
    loadVisitors();
    loadVisitorChart();

    // Update setiap 10 detik
    setInterval(function() {
        loadVisitors();
    }, 10000);
});
</script>
@endpush
