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
                                         <div class="row">
                                             <div class="col-12 col-xl-6">
                                                 <div class="row pb-2">
                                                     <div class="col-5 col-xl-6">
                                                         <h5 class="card-title">Arsip Dinamis</h5>
                                                     </div>
                                                     <div class="col-3 col-xl-6">
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
                                             <div class="col-12 col-xl-6">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Arsip Aktif</h5>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="d-flex align-items-center">
                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                                <a href="{{ $staticArchive != 0 ? route('archive-index', ['archive_subtype' => 'Aktif']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
                                                                    <i class="bi bi-menu-button-wide"></i>
                                                                </a>
                                                            </div>
                                                            <div class="ps-3">
                                                                <h6>{{ $activeArchive }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Arsip Inaktif</h5>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="d-flex align-items-center">
                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                                <a href="{{ $staticArchive != 0 ? route('archive-index', ['archive_subtype' => 'Inaktif']) : route('archive-index') }}" class="card-icon rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="color: inherit;">
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
                                 </div>
                             </div>
                         </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row justify-content-center px-2 mb-2">
                        <!-- Card 1 -->
                        <div class="col-12 col-xl-3 pb-2">
                            <div class="card info-card total-archive-card">
                                <div class="card-body">
                                    <h5 class="card-title text-xl-center">Disimpan</h5>
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

                        <!-- Card 2 -->
                        <div class="col-12 col-xl-3 pb-2">
                            <div class="card info-card total-archive-card">
                                <div class="card-body">
                                    <h5 class="card-title text-xl-center">Usul Musnah</h5>
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

                        <!-- Card 3 -->
                        <div class="col-12 col-xl-3 pb-2">
                            <div class="card info-card total-archive-card">
                                <div class="card-body">
                                    <h5 class="card-title text-xl-center">Musnah</h5>
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
                                             <div class="col-12 col-xl-6">
                                                <div class="row pb-2">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Diserahkan</h5>
                                                    </div>
                                                    <div class="col-7">
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
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Disimpan</h5>
                                                    </div>
                                                    <div class="col-7">
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
                         </div>
                    </div>
                </div>
            </div>

            <div class="card autumn-beige mb-3">
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
                                                         <h5 class="card-title">Arsip Permanen</h5>
                                                     </div>
                                                     <div class="col-3 col-xl-6">
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
                                             <div class="col-12 col-xl-6">
                                                <div class="row pb-2">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Diserahkan</h5>
                                                    </div>
                                                    <div class="col-7">
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
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Disimpan</h5>
                                                    </div>
                                                    <div class="col-7">
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
                         </div>
                    </div>
                </div>
            </div>

            <div class="card muted-rose mb-3">
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
                                                         <h5 class="card-title">Arsip Vital</h5>
                                                     </div>
                                                     <div class="col-3 col-xl-6">
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
                                             <div class="col-12 col-xl-6">
                                                <div class="row pb-2">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Diserahkan</h5>
                                                    </div>
                                                    <div class="col-7">
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
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5 class="card-title">Disimpan</h5>
                                                    </div>
                                                    <div class="col-7">
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
                         </div>
                    </div>
                </div>
            </div>

            @include('apps.dashboard.pie-chart')
            
        </section>
    </main>
@endsection

@push('scripts')
    <!-- Script Pie Chart-->
    <script>
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

    </script>

@endpush