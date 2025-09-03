@extends('layouts.app')

@push('css')
    <style>
        .purple {
            background: #6e44ff;
            color: white;
        }
        .hydrogen {
            background: #6699cc;
            color: white;
        }
        .cool-mist {
            background: #a8dadc;
            color: #1d1d1d;   
        }
        .autumn-beige {
            background: #e6b8a2;
            color: #262626;   
        }
        .muted-rose {
            background: #d8a7b1;
            color: #333333;   
        }
        .bg-slate{
            background: #f2f1ee;
        }
    </style>
@endpush

@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="pagetitle">
                <h1>Dashboard</h1>
            </div>
            <div class="card purple">
                <div class="card-body px-2 py-2">
                    <div class="container-fluid">
                        <div class="row mt-3">
                            <!-- Total Archive Card (Full width on XL, centered) -->
                            <div class="col-12 col-xl-12">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Arsip</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ route('archive-index') }}" class="text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totalArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid">
                        <div class="row mt-3">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-6">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Dinamis</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $dynamicArchive != 0 ? route('archive-index', ['archive_type' => 'Dinamis']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $dynamicArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-6">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Statis</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $staticArchive != 0 ? route('archive-index', ['archive_type' => 'Statis']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $staticArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="card cool-mist">
                <div class="card-body px-2 py-2">
                    <div class="col-12 col-xl-12 px-2 pt-2">
                        <div class="card info-card total-archive-card">
                            <div class="card-body">
                                <h5 class="card-title">Arsip Dinamis</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <a href="{{ $dynamicArchive != 0 ? route('archive-index', ['archive_type' => 'Dinamis']) : route('archive-index') }}" class="text-decoration-none" style="color: inherit;">
                                            <i class="bi bi-menu-button-wide"></i>
                                        </a>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $dynamicArchive }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row mt-3">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-6">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Aktif</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $activeArchive != 0 ? route('archive-index', ['status' => 'Diserahkan']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $activeArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-6">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Inaktif</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $inactiveArchive != 0 ? route('archive-index', ['status' => 'Simpan']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $inactiveArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="container-fluid">
                        <div class="row mt-3">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-3">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body"> 
                                        <h5 class="card-title">Arsip Diserahkan</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $submittedDynamicArchive != 0 ? route('archive-index', ['archive_subtype' => 'Aktif']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $submittedDynamicArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-3">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Disimpan</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $savedDynamicArchive != 0 ? route('archive-index', ['archive_subtype' => 'Inaktif']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $savedDynamicArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="col-12 col-md-3">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Usul Musnah</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $proposedForDestructionArchive != 0 ? route('archive-index', ['status' => 'Usul Musnah']) : route('archive-index') }}" class="text-decoration-none" style="color: inherit;">
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

                            <!-- Card 4 -->
                            <div class="col-12 col-md-3">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Musnah</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $destructionArchive != 0 ? route('archive-index', ['status' => 'Musnah']) : route('archive-index') }}" class="text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $destructionArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="card hydrogen">
                <div class="card-body px-2 py-2">
                    <div class="col-12 col-xl-12 px-2 pt-2">
                        <div class="card info-card total-archive-card">
                            <div class="card-body">
                                <h5 class="card-title">Arsip Statis</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <a href="{{ $staticArchive != 0 ? route('archive-index', ['archive_type' => 'Statis']) : route('archive-index') }}" class="text-decoration-none" style="color: inherit;">
                                            <i class="bi bi-menu-button-wide"></i>
                                        </a>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $staticArchive }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row mt-3">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-6">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Diserahkan</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $submittedStaticArchive != 0 ? route('archive-index', ['status' => 'Diserahkan']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $submittedStaticArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-6">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Disimpan</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $savedStaticArchive != 0 ? route('archive-index', ['status' => 'Simpan']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $savedStaticArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            
            <div class="card autumn-beige">
                <div class="card-body px-2 py-2">
                    <div class="col-12 col-xl-12 px-2 py-2">
                        <div class="card info-card total-archive-card">
                            <div class="card-body">
                                <h5 class="card-title">Arsip Permanen</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <a href="{{ $permanentArchive != 0 ? route('archive-index', ['archive_type' => 'Permanen']) : route('archive-index') }}" class="text-decoration-none" style="color: inherit;">
                                            <i class="bi bi-menu-button-wide"></i>
                                        </a>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $permanentArchive }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row mt-3">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-6">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Diserahkan</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $submittedPermanentArchive != 0 ? route('archive-index', ['status' => 'Diserahkan']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $submittedPermanentArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-6">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Disimpan</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $savedPermanentArchive != 0 ? route('archive-index', ['status' => 'Simpan']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $savedPermanentArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            
            <div class="card muted-rose">
                <div class="card-body px-2 py-2">
                    <div class="col-12 col-xl-12 px-2 py-2">
                        <div class="card info-card total-archive-card">
                            <div class="card-body">
                                <h5 class="card-title">Arsip Vital</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <a href="{{ $vitalArchive != 0 ? route('archive-index', ['archive_type' => 'Vital']) : route('archive-index') }}" class="text-decoration-none" style="color: inherit;">
                                            <i class="bi bi-menu-button-wide"></i>
                                        </a>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $vitalArchive }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row mt-3">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-6">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Diserahkan</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $submittedVitalArchive != 0 ? route('archive-index', ['status' => 'Diserahkan']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $submittedVitalArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-6">
                                <div class="card info-card total-archive-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Arsip Disimpan</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <a href="{{ $savedVitalArchive != 0 ? route('archive-index', ['status' => 'Simpan']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                    <i class="bi bi-menu-button-wide"></i>
                                                </a>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $savedVitalArchive }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="row">
                <div class="mx-auto">
                    <div class="card bg-slate">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                Diagram
                            </h5>
                            <div class="text-center">
                                <div style="max-width: 500px; margin: auto;">
                                    <canvas id="archiveChart"></canvas>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="row mt-3">
                                    <!-- Card 1 -->
                                    <div class="col-12 col-md-3">
                                        <div class="card info-card total-archive-card">
                                            <div class="card-body">
                                                <h5 class="card-title">Arsip Dinamis</h5>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <h6>{{ $dynamicArchivePercentage }} %</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 2 -->
                                    <div class="col-12 col-md-3">
                                        <div class="card info-card total-archive-card">
                                            <div class="card-body">
                                                <h5 class="card-title">Arsip Statis</h5>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <h6>{{ $staticArchivePercentage }} %</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 3 -->
                                    <div class="col-12 col-md-3">
                                        <div class="card info-card total-archive-card">
                                            <div class="card-body">
                                                <h5 class="card-title">Arsip Permanen</h5>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <h6>{{ $permanentArchivePercentage }} %</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 4 -->
                                    <div class="col-12 col-md-3">
                                        <div class="card info-card total-archive-card">
                                            <div class="card-body">
                                                <h5 class="card-title">Arsip Vital</h5>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <h6>{{ $vitalArchivePercentage }} %</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
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
                        align: 'center'
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