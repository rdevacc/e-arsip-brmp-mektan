@extends('layouts.app')

@push('css')
    <style>
        .min-vh-70 {
            min-height: 70vh;
        }
    </style>
@endpush

@section('title')
    Dasar Hukum | E-Arsip BRMP Mektan
@endsection

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
                <div class="card-header fw-bold">
                    DASAR HUKUM PELAKSANAAN PENGELOLAAN KEARSIPAN
                </div>
                <div class="card-body min-vh-70">
                    <p class="mb-3">
                    Dasar hukum pengelolaan arsip di Balai Besar Perakitan dan Modernisasi Mekanisasi Pertanian, mengikuti dasar hukum sebagai berikut:
                    </p>
                    <ol class="mb-0 ps-3">
                    <li class="mb-2 ms-4">Undang-Undang No. 43 Tahun 2009 tentang Kearsipan</li>
                    <li class="mb-2 ms-4">Peraturan Pemerintah No. 28 Tahun 2012 tentang Pelaksanaan Undang-Undang No. 43 Tahun 2009 tentang Kearsipan</li>
                    <li class="mb-2 ms-4">Permentan Nomor 121/Permentan/OT.140/10/2014 tentang Klasifikasi Arsip Lingkup Kementerian Pertanian</li>
                    <li class="mb-2 ms-4">Peraturan Kepala Arsip Nasional Republik Indonesia Nomor 37 Tahun 2016 Tentang Pedoman Penyusutan Arsip</li>
                    <li class="mb-2 ms-4">Permentan Nomor 40/Permentan/TU.140/9/2018 tentang Jadwal Retensi Arsip Lingkup Kementerian Pertanian</li>
                    <li class="mb-2 ms-4">Peraturan Arsip Nasional Republik Indonesia Nomor 9 Tahun 2018 Tentang Pedoman Pemeliharaan Arsip Dinamis</li>
                    <li class="mb-2 ms-4">Keputusan Kepala Arsip Nasional Republik Indonesia Nomor 03 Tahun 2000 Tentang Standar Minimal Gedung dan Ruang Penyimpanan Arsip Inaktif Arsip Nasional Republik Indonesia Tahun 2001</li>
                    <li class="mb-2 ms-4">Peraturan Kepala Arsip Nasional Republik Indonesia Nomor 4 Tahun 2017 Tentang Pelaksanaan Tugas Jabatan Fungsional Arsiparis</li>
                    <li class="mb-2 ms-4">Perpres Nomor 95 Tahun 2018 tentang Sistem Pemerintahan Berbasis Elektronik (SPBE)</li>
                    <li class="mb-2 ms-4">Perka ANRI Nomor 20/2011 tentang Autentikasi Arsip Elektronik</li>
                    </ol>
                </div>
            </div>

        </section>
    </main>
@endsection