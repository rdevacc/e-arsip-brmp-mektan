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
        @media (min-width: 992px) {  /* Bootstrap breakpoint LG */
            .fs-lg-7 {
                font-size: 0.80rem !important;
            }
        }
    </style>
@endpush

@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="pagetitle">
                <h1>Dashboard</h1>
            </div>
            <div class="card purple mb-3">
                <div class="card-body px-2 py-2 my-2">
                    <div class="container-fluid">
                         <div class="card info-card total-archive-card">
                             <div class="row">
                                 <div class="col-12 col-xl-12">
                                     <div class="card-body">
                                         <div class="row">
                                             <div class="col-12 col-xl-6">
                                                 <div class="row pb-2">
                                                     <div class="col-5 col-xl-6">
                                                         <h5 class="card-title">Total Arsip</h5>
                                                     </div>
                                                     <div class="col-3 col-xl-6">
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
                                             <div class="col-12 col-xl-6">
                                                <div class="row pb-2">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Arsip Dinamis</h5>
                                                    </div>
                                                    <div class="col-7">
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
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Arsip Statis</h5>
                                                    </div>
                                                    <div class="col-7">
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
                </div>
            </div>

            <div class="card cool-mist mb-3">
                <div class="card-body px-2 py-2 my-2">
                    <div class="container-fluid">
                         <div class="card info-card total-archive-card">
                             <div class="row py-2">
                                 <div class="col-12 col-xl-12">
                                     <div class="card-body">
                                        <div class="row g-3">
                                            <!-- Kolom Arsip Dinamis -->
                                            <div class="col-12 col-xl-6">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <span class="card-title">Arsip Dinamis</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <h6 class="mb-0">{{ $dynamicArchive }}</h6>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Arsip Aktif -->
                                            <div class="col-12 col-xl-6">
                                                <!-- Arsip Aktif -->
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-6">
                                                        <h5 class="card-title mb-0">Arsip Aktif</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <h6 class="mb-0">{{ $activeArchive }}</h6>
                                                    </div>
                                                </div>

                                                <!-- Arsip Inaktif -->
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-6">
                                                        <h5 class="card-title mb-0">Arsip Inaktif</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <h6 class="mb-0">{{ $inactiveArchive }}</h6>
                                                    </div>
                                                </div>

                                                <!-- Arsip Permanen -->
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-6">
                                                        <h5 class="card-title mb-0">Arsip Permanen</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <h6 class="mb-0">{{ $permanentArchive }}</h6>
                                                    </div>
                                                </div>

                                                <!-- Arsip Vital -->
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <h5 class="card-title mb-0">Arsip Vital</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <h6 class="mb-0">{{ $vitalArchive }}</h6>
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
                <div class="container-fluid">
                    <div class="row justify-content-center text-center px-2 mb-2">
                        <!-- Card 1 -->
                        <div class="col-12 col-xl-3 pb-2">
                            <div class="card info-card total-archive-card">
                                <div class="card-body">
                                    <h5 class="card-title text-xl-center">Disimpan</h5>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="ps-3">
                                            <h6>{{ $savedDynamicArchive }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-12 col-xl-3 pb-2">
                            <div class="card info-card total-archive-card">
                                <div class="card-body">
                                    <h5 class="card-title text-xl-center">Usul Musnah</h5>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="ps-3">
                                            <h6>{{ $proposedForDestructionArchive }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-12 col-xl-3 pb-2">
                            <div class="card info-card total-archive-card">
                                <div class="card-body">
                                    <h5 class="card-title text-xl-center">Musnah</h5>
                                    <div class="d-flex justify-content-center align-items-center">
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

            <div class="card hydrogen mb-3">
                <div class="card-body px-2 py-2 my-2">
                    <div class="container-fluid">
                         <div class="card info-card total-archive-card">
                             <div class="row">
                                 <div class="col-12 col-xl-12">
                                     <div class="card-body">
                                         <div class="row">
                                             <div class="col-12 col-xl-6">
                                                 <div class="row pb-2">
                                                     <div class="col-5 col-xl-6">
                                                         <h5 class="card-title">Arsip Statis</h5>
                                                     </div>
                                                     <div class="col-3 col-xl-6">
                                                         <div class="d-flex align-items-center">
                                                             <div class="ps-3">
                                                                 <h6>{{ $staticArchive }}</h6>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-12 col-xl-6">
                                                <div class="row pb-2">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Diserahkan</h5>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="d-flex align-items-center">
                                                            <div class="ps-3">
                                                                <h6>{{ $submittedStaticArchive }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Disimpan</h5>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="d-flex align-items-center">
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
                         </div>
                    </div>
                </div>
            </div>

            @include('apps.dashboard.bar-chart')
            {{-- @include('apps.dashboard.pie-chart') --}}
            
        </section>
    </main>
@endsection

@push('scripts')
    <!-- Script Pie Chart-->
    {{-- <script>
        // === FUNGSI GENERATE WARNA PASTEL ===
        function generatePastelColors(count) {
            let colors = [];
            for (let i = 0; i < count; i++) {
                const hue = Math.floor(Math.random() * 360);
                colors.push(`hsl(${hue}, 70%, 80%)`);
            }
            return colors;
        }

         // === FUNGSI BUAT CHART ===
        function createPieChart(canvasId, labels, data) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            const total = data.reduce((a, b) => a + b, 0);
            const backgroundColors = generatePastelColors(data.length);

            return new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        datalabels: {
                            color: '#333',
                            formatter: (value) => {
                                let percentage = total > 0 ? (value / total * 100).toFixed(1) : 0;
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
                                    const percent = total > 0 ? (value / total * 100).toFixed(1) : 0;
                                    return `${label}: ${value} arsip (${percent}%)`;
                                }
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        }

        // === DATA DARI CONTROLLER ===
        const labels1 = {!! json_encode($chartLabels1) !!};
        const data1   = {!! json_encode($chartData1) !!};

        const labels2 = {!! json_encode($chartLabels2) !!};
        const data2   = {!! json_encode($chartData2) !!};

        const labels3 = {!! json_encode($chartLabels3) !!};
        const data3   = {!! json_encode($chartData3) !!};

        // === INISIALISASI 3 CHART ===
        createPieChart('archiveChart', labels1, data1);
        createPieChart('dynamicArchiveChart', labels2, data2);
        createPieChart('staticArchiveChart', labels3, data3);
    </script> --}}

    <script>
        // Chart 1: Arsip per Kategori
        const ctx1 = document.getElementById('chartBar1');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: @json($chartBar1['labels']),
                datasets: [{
                    label: 'Jumlah Arsip',
                    data: @json($chartBar1['data']),
                    backgroundColor: ['#36A2EB', '#FF6384', '#4BC0C0', '#FFCE56'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Chart 2: Subtype Arsip
        const ctx2 = document.getElementById('chartBar2');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($chartBar2['labels']),
                datasets: [{
                    label: 'Arsip Dinamis',
                    data: @json($chartBar2['data']),
                    backgroundColor: ['#FF9F40', '#9966FF', '#36A2EB', '#FF6384'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Chart 3: Arsip Statis Disimpan vs Diserahkan
        const ctx3 = document.getElementById('chartBar3');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: @json($chartBar3['labels']),
                datasets: [{
                    label: 'Arsip Statis',
                    data: @json($chartBar3['data']),
                    backgroundColor: ['#4BC0C0', '#FF6384'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>

@endpush