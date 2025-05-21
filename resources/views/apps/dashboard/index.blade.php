@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="pagetitle">
                <h1>Dashboard</h1>
                {{-- <nav>
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Arsip</li>
                    </ol>
                </nav> --}}
            </div>

            <div class="row">
                <!-- Total Archive Card -->
                <div class="col-xxl-4 col-md-12">
                <div class="card info-card total-archive-card">
                    <div class="card-body">
                    <h5 class="card-title">Total Arsip <span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <a href="{{ route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                <i class="bi bi-menu-button-wide"></i>
                            </a>
                        </div>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $totalArchive }}</h6>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Total Archive Card -->
            </div>
            
            <div class="row">
                <!-- Active Archive Card -->
                <div class="col-xxl-4 col-md-4">
                <div class="card info-card total-archive-card">
                    <div class="card-body">
                    <h5 class="card-title">Arsip Aktif <span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-menu-button-wide"></i>
                        </div>
                        <div class="ps-3">
                        <h6>{{ $activeArchive }}</h6>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Active Archive Card -->

                <!-- Inactive Archive Card -->
                <div class="col-xxl-4 col-md-4">
                <div class="card info-card total-archive-card">
                    <div class="card-body">
                    <h5 class="card-title">Arsip Inaktif <span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-menu-button-wide"></i>
                        </div>
                        <div class="ps-3">
                        <h6>{{ $inactiveArchive }}</h6>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Inactive Archive Card -->

                <!-- Vital Archive Card -->
                <div class="col-xxl-4 col-md-4">
                <div class="card info-card total-archive-card">
                    <div class="card-body">
                    <h5 class="card-title">Arsip Vital <span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-menu-button-wide"></i>
                        </div>
                        <div class="ps-3">
                        <h6>{{ $vitalArchive }}</h6>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Vital Archive Card -->
            </div>

            <div class="row">
                <!-- Preserved Archive Card -->
                <div class="col-xxl-4 col-md-4">
                <div class="card info-card total-archive-card">
                    <div class="card-body">
                    <h5 class="card-title">Arsip Terjaga <span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <a href="{{ route('archive-index', ['status' => 'Terjaga']) }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                <i class="bi bi-menu-button-wide"></i>
                            </a>
                        </div>
                        </div>
                        <div class="ps-3">
                        <h6>{{ $preservedArchive }}</h6>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Preserved Archive Card -->

                <!-- Proposed for Destruction Archive Card -->
                <div class="col-xxl-4 col-md-4">
                <div class="card info-card total-archive-card">
                    <div class="card-body">
                    <h5 class="card-title">Arsip Usul Musnah <span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <a href="{{ route('archive-index', ['status' => 'Usul Musnah']) }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                <i class="bi bi-menu-button-wide"></i>
                            </a>
                        </div>
                        <div class="ps-3">
                        <h6>{{ $proposedForDestructionArchive }}</h6>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Proposed for Destruction Archive Card -->

                <!-- Proposed for Destruction Archive Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card total-archive-card">
                        <div class="card-body">
                        <h5 class="card-title">Arsip Musnah <span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-menu-button-wide"></i>
                            </div>
                            <div class="ps-3">
                            <h6>{{ $destructionArchive }}</h6>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- End Proposed for Destruction Archive Card -->
            </div>

            <div class="row">
                <!-- Static Archive Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card total-archive-card">
                        <div class="card-body">
                        <h5 class="card-title">Arsip Statis <span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-menu-button-wide"></i>
                            </div>
                            <div class="ps-3">
                            <h6>{{ $staticArchive }}</h6>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- End Static Archive Card -->
            </div>

            <!-- Pie Chart -->
            <div class="row">
                <div class="mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                Diagram
                            </h5>
                            <div class="text-center">
                                <div style="max-width: 500px; margin: auto;">
                                    <canvas id="archiveChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Pie Chart -->

        </section>
    </main>
@endsection

@push('scripts')
    <!-- Script Pie Chart-->
    <script>
        const ctx = document.getElementById('archiveChart').getContext('2d');

        const dataValues = {!! json_encode($chartData) !!};
        const labels = {!! json_encode($chartLabels) !!};
        const total = dataValues.reduce((a, b) => a + b, 0);

        // Fungsi untuk generate warna pastel acak
        function generatePastelColors(count) {
            let colors = [];
            for (let i = 0; i < count; i++) {
                const hue = Math.floor(Math.random() * 360); // acak warna
                colors.push(`hsl(${hue}, 70%, 80%)`); // pastel dengan lightness tinggi
            }
            return colors;
        }

        const backgroundColors = generatePastelColors(dataValues.length);

        const archivePieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: backgroundColors,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#333',
                        formatter: (value, context) => {
                            let percentage = (value / total * 100).toFixed(1);
                            return percentage + '%';
                        }
                    },
                    legend: {
                        position: 'bottom',
                        align: 'start'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                const percent = (value / total * 100).toFixed(1);
                                return `${label}: ${value} arsip (${percent}%)`;
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>

@endpush