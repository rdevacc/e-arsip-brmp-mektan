@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.0/r-3.0.0/datatables.min.css" rel="stylesheet">

    {{-- DataTable Button CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.bootstrap5.css">

    {{-- Daterange CSS --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush


@section('content')
    <main id="main" class="main">
        <section class="section">

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
            <!-- Content Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Card Body -->
                            <h4 class="card-title px-5">Data Arsip</h4>

                            <div class="row px-5">
                                <div class="row mt-3">
                                    <span class="col-sm-4 fw-semibold">Unit Kerja</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->work_unit->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Kelompok Kerja</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->work_group->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Tim Kerja</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->work_team->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Kode Klasifikasi</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->work_team_classification->code ?? "-" }} - {{ $archive->work_team_classification->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Keterangan Klasifikasi</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_classification_description ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Retensi Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_retention->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Tipe Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_type->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Sub Tipe Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_subtype->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Status Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_status->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Nomor Asal Surat</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_letter_origin_number ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Uraian Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_description ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Kurun Waktu Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_lifespan ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Tingkat Perkembangan Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_development_level->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Media Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_media->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Kondisi Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_condition->name ?? "-" }}</p>
                                    </div>
                                </div>
                                 <div class="row">
                                    <span class="col-sm-4 fw-semibold">Jumlah Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_number ?? "-" }} {{ $archive->archive_quantity_unit->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Tindakan Penyusutan Akhir Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_final_depreciation_action->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Klasifikasi Keamanan Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_security_classification->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Akses Level Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_access_level->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Tingkat Akses Publik Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_public_access_level->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Tanggal Input Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_input_date ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Periode Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_period->name ?? "-" }} Tahun {{ $archive->year_period ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Keterangan Tambahan</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->additional_information ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Lokasi Penyimpanan Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_storage_location->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Tempat Penyimpanan Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_storage_place->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Baris Penyimpanan Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->archive_shelf_row->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Box Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->box->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-sm-4 fw-semibold">Folder Arsip</span>
                                    <div class="col-sm-8">
                                        <p>{{ $archive->folder->name ?? "-" }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mt-3 mb-2 me-2 text-end">
                                        <a href="{{ route('archive-index') }}" class="btn btn-secondary">Kembali</a>
                                        @can('super-admin')
                                        <a href="{{ route('archive-edit', $archive->id) }}" class="btn btn-warning">Edit</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables -->
@endpush