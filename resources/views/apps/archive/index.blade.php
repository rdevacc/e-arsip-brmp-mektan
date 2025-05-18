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
            <div class="pagetitle">
                <h1>Data Arsip</h1>
                {{-- <nav>
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Arsip</li>
                    </ol>
                </nav> --}}
            </div>

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
                            {{-- <h4 class="card-title">Data Seluruh Arsip</h4> --}}

                            <div class="row d-flex flex-wrap align-items-end">
                                <!-- Button Section -->
                                <div class="col mb-2 d-flex">
                                    <!-- Tombol Tambah -->
                                    <div>
                                        <a href="{{ route('archive-create') }}" class="btn btn-primary me-1">Tambah</a>
                                    </div>
                                    {{-- <div>
                                        <form action="{{ route('excel') }}" method="post" class="me-1">
                                            @csrf
                                            <div>
                                                <button type="submit" class="btn btn-success"
                                                    id="excelButton">Excel</button>
                                                <input type="hidden" name="excelDataStart" id="excelDataStart">
                                                <input type="hidden" name="excelDataEnd" id="excelDataEnd">
                                                <input type="hidden" name="excelDataSearch" id="excelDataSearch">
                                            </div>
                                        </form>
                                    </div>
                                    <div>
                                        <form action="{{ route('pdf') }}" method="post">
                                            @csrf
                                            <div>
                                                <button type="submit" class="btn btn-danger" id="PDFButton">PDF</button>
                                                <input type="hidden" name="PDFDataStart" id="PDFDataStart">
                                                <input type="hidden" name="PDFDataEnd" id="PDFDataEnd">
                                                <input type="hidden" name="PDFDataSearch" id="PDFDataSearch">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Date Range Filter -->
                                    <div class="col-xs-5 col-sm-3 ms-2">
                                        <div id="daterange"
                                            style="background: #fff;cursor:pointer;padding: 5px 10px;border:1px solid #ccc;width100%;text-align:center">
                                            <i class="bi bi-calendar"></i>&nbsp;
                                            <span></span>
                                            <i class="bi bi-caret-down-fill"></i>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- <div class="col-auto mb-2">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="searchField"
                                            placeholder="Cari Kegiatan">
                                        <button class="btn btn-outline-secondary" type="button" id="searchFieldBtn">
                                            <i class="bi bi-search"></i>
                                            Cari
                                        </button>
                                    </div>

                                </div> --}}
                                <div class="col-auto mb-2">
                                    <select id="filterLifespan" class="form-control" style="width: 200px;">
                                        <option value="">Semua Kurun Waktu</option>
                                        @foreach ($lifespanList as $lifespan)
                                            <option value="{{ $lifespan }}">{{ $lifespan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto mb-2">
                                    <select id="filterWorkTeamClassification" class="form-control" style="width: 200px;">
                                        <option value="">Semua Kode Klasifikasi</option>
                                        @foreach($workTeamClassificationList as $workTeamClassification)
                                            <option value="{{ $workTeamClassification->id }}">{{ $workTeamClassification->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto mb-2">
                                    <select id="filterArchiveStatus" class="form-control" style="width: 200px;">
                                        <option value="">Semua Status Arsip</option>
                                        @foreach($archiveStatusList as $archiveStatus)
                                            <option value="{{ $archiveStatus->name }}">{{ $archiveStatus->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table id="archives-table" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">
                                                #
                                            </th>
                                            <th class="text-center align-middle">
                                                Kode Klasifikasi
                                            </th>
                                            <th class="text-center align-middle">
                                                Uraian
                                            </th>
                                           <th class="text-center align-middle">
                                                Kurun Waktu
                                            </th>
                                            <th class="text-center align-middle">
                                                Status Arsip
                                            </th>
                                            <th class="text-center align-middle">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Load Data -->
    <script>
        $(function () {
            var table = $('#archives-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('archive-index') }}",
                    data: function (d) {
                        d.work_team_classification = $('#filterWorkTeamClassification').val();
                        d.archive_status= $('#filterArchiveStatus').val();
                        d.archive_lifespan = $('#filterLifespan').val();
                    }
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '10px',
                        targets: 0,
                    },
                    { data: 'work_team_classification', name: 'work_team_classification' },
                    { data: 'archive_description', name: 'archive_description' },
                    { data: 'archive_lifespan', name: 'archive_lifespan' },
                    { data: 'archive_status', name: 'archive_status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            // Inisialisasi tooltip setiap kali tabel di-render ulang
            table.on('draw.dt', function () {
            $('[data-bs-toggle="tooltip"]').tooltip(); // Bootstrap 5
            });

            $('#filterWorkTeamClassification').change(function () {
                table.draw(); // refresh DataTables saat filter berubah
            });

            $('#filterArchiveStatus').change(function () {
                table.draw(); // refresh DataTables saat filter berubah
            });

            $('#filterLifespan').on('change', function() {
                table.draw();
            });
        });
    </script>

    <!-- Tooltip -->
    <script>
        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Delegate click event ke tombol dengan class .btn-delete
            document.querySelectorAll('.btn-delete').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();

                    const url = btn.getAttribute('data-url');
                    const form = btn.closest('form');

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data arsip tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

@endpush