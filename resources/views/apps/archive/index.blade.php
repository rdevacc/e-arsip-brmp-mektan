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

    <style>
        .select-ellipsis {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    </style>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <div class="row mx-1 mt-2 d-flex justify-content-between">
                                <!-- Tombol Tambah di kiri -->
                                <div class="col-md-auto mb-2">
                                    <a href="{{ route('archive-create') }}" class="btn btn-primary w-100 w-md-auto">Tambah</a>
                                </div>

                                <!-- Filter Section di kanan -->
                                <div class="col-md-auto">
                                    <div class="row row-cols-1 row-cols-md-3 g-2 justify-content-end">
                                        <!-- Filter Kurun Waktu -->
                                        <div class="col-md-auto">
                                            <div class="input-group">
                                                <select id="filterLifespan" class="form-select">
                                                    <option value="">Semua Kurun Waktu</option>
                                                    @foreach ($lifespanList as $lifespan)
                                                        <option value="{{ $lifespan }}">{{ $lifespan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Filter Kode Klasifikasi -->
                                        <div class="col-md-auto">
                                            <div class="input-group">
                                                <select id="filterWorkTeamClassification" class="form-select">
                                                    <option value="">Semua Kode Klasifikasi</option>
                                                    @foreach($workTeamClassificationList as $workTeamClassification)
                                                        <option value="{{ $workTeamClassification->code }}">{{ $workTeamClassification->code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Filter Status Arsip -->
                                        <div class="col-md-auto">
                                            <div class="input-group">
                                                <select id="filterArchiveStatus" class="form-select">
                                                    <option value="">Semua Status Arsip</option>
                                                    @foreach($archiveStatusList as $archiveStatus)
                                                        <option value="{{ $archiveStatus->name }}">{{ $archiveStatus->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
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
                                            <th class="text-center align-middle" style="width: 250px;">
                                                Uraian
                                            </th>
                                           <th class="text-center align-middle">
                                                Kurun Waktu
                                            </th>
                                            <th class="text-center align-middle">
                                                Status Arsip
                                            </th>
                                            <th class="text-center align-middle" style="width: 200px;">
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
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '10px' },
                    { data: 'work_team_classification', name: 'work_team_classification_code' },
                    { data: 'archive_description', name: 'archive_description', orderable: false },
                    { data: 'archive_lifespan', name: 'archive_lifespan' },
                    { data: 'archive_status', name: 'archive_status_name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            // Tooltip Bootstrap 5
            table.on('draw.dt', function () {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });

            
             // Ubah status arsip
            $(document).on('change', '.status-select', function () {
                const statusId = parseInt($(this).val());
                const archiveId = $(this).data('id');
                const token = $('meta[name="csrf-token"]').attr('content');

                const updateStatus = () => {
                    $.ajax({
                        url: `/app/archive/${archiveId}/update-status`,
                        type: 'POST',
                        data: {
                            status_id: statusId,
                            _token: token
                        },
                        success: function (response) {
                            $('#archives-table').DataTable().ajax.reload(null, false); // Jangan reset halaman
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                        },
                        error: function (xhr) {
                            console.error('Gagal memperbarui status');
                            console.log(xhr.status, xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Tidak dapat memperbarui status arsip.'
                            });
                        }
                    });
                };

                if (statusId === 8) {
                    Swal.fire({
                        title: 'Yakin ingin memusnahkan arsip ini?',
                        text: 'Data lokasi arsip akan dikosongkan.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Musnahkan',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) updateStatus();
                        else $('#archives-table').DataTable().ajax.reload(null, false); // Kembalikan tampilan
                    });
                } else {
                    updateStatus();
                }
            });

            // Filter change event
            $('#filterWorkTeamClassification').change(function () { table.draw(); });
            $('#filterArchiveStatus').change(function () { table.draw(); });
            $('#filterLifespan').change(function () { table.draw(); });
        });

    </script>

    <!-- Tooltip -->
    <script>
        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>

    <!-- Delete -->
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

    <!-- Catch data value status dari dashboard -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const statusParam = urlParams.get('status');

            if (statusParam) {
                const select = document.getElementById('filterArchiveStatus');
                select.value = statusParam;

                // Trigger change event ke DataTable yg benar
                $('#filterArchiveStatus').trigger('change');
            }
        });

    </script>

@endpush