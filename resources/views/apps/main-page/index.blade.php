@extends('layouts.app')

@push('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
          crossorigin="anonymous">

    <style>
        .min-vh-80 {
            min-height: 80vh;
        }
    </style>
@endpush

@section('content')
    <main id="main" class="main">
        <section class="section quantity-unit">
             <!-- Session Alert -->
            @if (session('success'))
                <div class="alert alert-primary d-flex align-items-center justify-content-between" role="alert">
                    <div class="d-flex text-center align-middle">
                        {{ session('success') }}
                    </div>
                    <div class="justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-body min-vh-80 mt-4">
                    <div class="d-flex flex-column mx-auto justify-content-center align-items-center text-center">
                        <img src="{{ asset('admin/assets/img/logo-kementan.png') }}" alt="Logo-Kementan" width="300" eight="300">
                        <div class="d-flex flex-column" style="max-width: 1000px;">
                            <span class="fs-2 mb-2">Arsip Elektronik BRMP Mekanisasi Pertanian</span>
                            <span class=""><b>Arsip elektronik</b> adalah informasi atau dokumen yang dibuat, diterima, disimpan, dan dikelola dalam bentuk elektronik menggunakan teknologi komputer, sehingga <b>mudah untuk diakses, dicari, dan dikelola</b> oleh sistem komputer. Arsip ini bisa berasal dari dokumen fisik yang dipindai (arsip alih media) atau dokumen yang memang sejak awal dibuat dalam format digital, seperti surel atau basis data.</span>
                        </div>
                    </div>                   
                </div>
            </div>

        </section>
    </main>
@endsection

@push('scripts')
    <!-- Load Bootstrap Bundle once -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endpush