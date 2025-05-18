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
                        <i class="bi bi-menu-button-wide"></i>
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
                        <i class="bi bi-menu-button-wide"></i>
                        </div>
                        <div class="ps-3">
                        <h6>{{ $activeArchive }}</h6>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Preserved Archive Card -->

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

                <!-- Proposed for Destruction Archive Card -->
                <div class="col-xxl-4 col-md-4">
                <div class="card info-card total-archive-card">
                    <div class="card-body">
                    <h5 class="card-title">Arsip Usul Musnah <span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-menu-button-wide"></i>
                        </div>
                        <div class="ps-3">
                        <h6>{{ $proposedForDestructionArchive }}</h6>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Proposed for Destruction Archive Card -->
            </div>

            <div class="row">
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
        </section>
    </main>
@endsection