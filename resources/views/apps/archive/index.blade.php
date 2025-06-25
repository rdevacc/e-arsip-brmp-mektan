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
    },
    th:first-child,
    td:first-child {
        width: 1% !important;
        white-space: nowrap;
        padding-left: 0.25rem !important;
        padding-right: 0.25rem !important;
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
                            <div class="row mx-1 mt-2 d-flex justify-content-between align-items-center">
                                <!-- Tombol Tambah & Ubah Status di kiri -->
                                <div class="col-md-auto d-flex gap-2 mb-2">
                                    <a href="{{ route('archive-create') }}" class="btn btn-primary">Tambah</a>
                                    <button class="btn btn-warning" id="bulk-edit-btn" disabled>Ubah Massal</button>
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

                                        <div class="col-md-auto">
                                            <div class="input-group">
                                                <select id="filterPeriod" class="form-select">
                                                    <option value="">Semua Periode</option>
                                                    @foreach ($periodList as $period)
                                                        <option value="{{ $period->name }}">{{ $period->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-auto">
                                            <div class="input-group">
                                                <select id="filteryearPeriod" class="form-select">
                                                    <option value="">Semua Tahun Periode</option>
                                                    @foreach ($yearPeriodList as $yearPeriod)
                                                        <option value="{{ $yearPeriod }}">{{ $yearPeriod }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

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
                                           <th style="width: 1%; white-space: nowrap;">
                                                <input type="checkbox" id="select-all" style="margin: 0; transform: scale(1.2); vertical-align: middle;">
                                            </th>
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
                                                Periode
                                            </th>
                                           <th class="text-center align-middle">
                                                Tahun Periode
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
    
    <!-- Modal Ubah Status Massal -->
    <div class="modal fade" id="bulkEditModal" tabindex="-1" aria-labelledby="bulkEditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="bulk-edit-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Massal Arsip</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Status Arsip</label>
                            <select class="form-select" id="bulk-status-select">
                                <option selected disabled value="">Pilih Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Periode</label>
                            <select class="form-select" id="bulk-period-select">
                                <option selected disabled value="">Pilih Periode</option>
                                @foreach($periodList as $period)
                                    <option value="{{ $period->id }}">{{ $period->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tahun Periode</label>
                            <input type="text" class="form-control" id="bulk-year-period-input" placeholder="Contoh: 2025">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


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
                        d.period = $('#filterPeriod').val();
                        d.year_period = $('#filterYearPeriod').val();
                    }
                },
                columns: [
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        width: '1%',
                        render: function (data) {
                            return `<input type="checkbox" class="row-checkbox" value="${data}" style="margin:0; transform: scale(1.2); vertical-align: middle;">`;
                        }
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '10px',
                        className: 'text-center'
                    },
                    { data: 'work_team_classification', name: 'work_team_classification_code' },
                    { data: 'archive_description', name: 'archive_description', orderable: false },
                    { data: 'archive_lifespan', name: 'archive_lifespan' },
                    { data: 'period_name', name: 'period_name' },
                    { data: 'year_period', name: 'year_period_name' },
                    { data: 'archive_status', name: 'archive_status_name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            // Pilih Semua Checkbox
            $('#select-all').on('click', function () {
                $('.row-checkbox').prop('checked', this.checked);
                toggleBulkButton();
            });

            // Cek satu per satu
            $(document).on('change', '.row-checkbox', function () {
                $('#select-all').prop('checked', $('.row-checkbox:checked').length === $('.row-checkbox').length);
                toggleBulkButton();
            });


            // Shift + klik
            let lastChecked = null;
            $(document).on('click', '.row-checkbox', function (e) {
                if (!lastChecked) {
                    lastChecked = this;
                    return;
                }

                if (e.shiftKey) {
                    const checkboxes = $('.row-checkbox');
                    const start = checkboxes.index(this);
                    const end = checkboxes.index(lastChecked);

                    const isChecked = lastChecked.checked;

                    checkboxes.slice(Math.min(start, end), Math.max(start, end) + 1)
                        .prop('checked', isChecked);
                    
                    toggleBulkButton();
                }

                lastChecked = this;
            });


            // Toggle tombol bulk
            function toggleBulkButton() {
                const anyChecked = $('.row-checkbox:checked').length > 0;
                $('#bulk-edit-btn').prop('disabled', !anyChecked);
            }

            // Tampilkan modal
            $('#bulk-edit-btn').on('click', function () {
                $('#bulkEditModal').modal('show');
            });

            // Submit form
            $('#bulk-edit-form').on('submit', function (e) {
                e.preventDefault();
                const selectedIDs = $('.row-checkbox:checked').map(function () {
                    return this.value;
                }).get();

                const newStatus = $('#bulk-status-select').val();
                const newPeriod = $('#bulk-period-select').val();
                const newYearPeriod = $('#bulk-year-period-input').val();

                if (!newStatus && !newPeriod && !newYearPeriod) {
                    Swal.fire('Peringatan', 'Pilih minimal 1 perubahan.', 'warning');
                    return;
                }

                $.ajax({
                    url: "{{ route('archive-bulk-update') }}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        ids: selectedIDs,
                        status_id: newStatus,
                        period_id: newPeriod,
                        year_period: newYearPeriod
                    },
                    success: function (response) {
                        $('#bulkEditModal').modal('hide');
                        $('#archives-table').DataTable().ajax.reload(function (){
                            $('#select-all').prop('checked', false);
                            lastChecked = null;
                            toggleBulkButton()
                        }, false);
                        Swal.fire('Berhasil', response.message, 'success')
                        .then(() => {
                            location.reload();
                        });
                    },
                    error: function () {
                        Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data.', 'error');
                    }
                });
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
            $('#filterPeriod').change(function () { table.draw(); });
            $('#filterYearPeriod').change(function () { table.draw(); });
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