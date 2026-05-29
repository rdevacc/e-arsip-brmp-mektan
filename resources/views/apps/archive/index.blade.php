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
        .cool-mist {
            background: #a8dadc;
            color: #1d1d1d;    
        }
    </style>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('title')
    Arsip | E-Arsip BRMP Mektan
@endsection

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
            <div class="card cool-mist mb-4">
                <div class="card-body">
                    @auth
                    <div class="row mx-1 py-2 d-flex justify-content-between align-items-center">
                        <!-- Tombol Tambah & Ubah Status di kiri -->
                        @canany(['pengguna', 'super-admin'])
                            <div class="col-md-auto d-flex gap-2 mb-2">
                                <a href="{{ route('archive-create') }}" class="btn btn-primary">Tambah</a>
                                @can('super-admin')
                                    <a href="{{ route('import-excel.index') }}" class="btn btn-success">Upload Excel</a>
                                    <button class="btn btn-warning" id="bulk-edit-btn" disabled>Ubah Massal</button>
                                    <button class="btn btn-danger" id="bulk-delete-btn" disabled>Delete Massal</button>
                                @endcan
                            </div>
                        @endcanany
                    </div>
                    @endauth
                    <div class="row mx-1 mb-3">
                        <div class="col-md-3">
                            <label for="filterLifespan" class="form-label">Kurun Waktu</label>
                            <select id="filterLifespan" class="form-select">
                                <option value="">Pilih Kurun Waktu</option>
                                @foreach ($lifespanList as $lifespan)
                                    <option value="{{ $lifespan }}">{{ $lifespan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterPeriod" class="form-label">Periode</label>
                            <select id="filterPeriod" class="form-select">
                                <option value="">Pilih Periode</option>
                                @foreach ($periodList as $period)
                                    <option value="{{ $period->name }}">{{ $period->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterYearPeriod" class="form-label">Tahun Periode</label>
                            <select id="filterYearPeriod" class="form-select">
                                <option value="">Pilih Tahun Periode</option>
                                @foreach ($yearPeriodList as $yearPeriod)
                                    <option value="{{ $yearPeriod }}">{{ $yearPeriod }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterWorkTeamClassification" class="form-label">Kode Klasifikasi</label>
                            <select id="filterWorkTeamClassification" class="form-select">
                                <option selected value="">Pilih Kode Klasifikasi</option>
                                @foreach ($workTeamClassificationList as $workTeamClassification)
                                    <option value="{{ $workTeamClassification->code }}">{{ $workTeamClassification->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mx-1 mb-3">
                        <div class="col-md-3">
                            <label for="filterArchiveType" class="form-label">Tipe Arsip</label>
                            <select id="filterArchiveType" class="form-select">
                                <option selected value="">Pilih Tipe Arsip</option>
                                @foreach ($archiveTypeList as $archiveType)
                                    <option value="{{ $archiveType->name }}">{{ $archiveType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterArchiveSubType" class="form-label">Subtipe Arsip</label>
                            <select id="filterArchiveSubType" class="form-select">
                                <option selected value="">Pilih Subtipe Arsip</option>
                                @foreach ($archiveSubTypeList as $archiveSubType)
                                    <option value="{{ $archiveSubType->name }}">{{ $archiveSubType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterArchiveStatus" class="form-label">Status Arsip</label>
                            <select id="filterArchiveStatus" class="form-select">
                                <option selected value="">Pilih Status Arsip</option>
                                @foreach ($archiveStatusList as $archiveStatus)
                                    <option value="{{ $archiveStatus->name }}">{{ $archiveStatus->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mx-1 mt-4 mb-3">
                        <div class="input-group">
                            <input type="text" id="text_search" class="form-control" placeholder="Cari judul atau uraian arsip...">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                              
                            <!-- Table with stripped rows -->
                            <div class="table-responsive mx-1">
                                <table id="archives-table" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            @can('super-admin')
                                            <th style="width: 1%; white-space: nowrap;">
                                                 <input type="checkbox" id="select-all" style="margin: 0; transform: scale(1.2); vertical-align: middle;">
                                            </th>
                                            @endcan
                                            <th class="text-center align-middle">
                                                #
                                            </th>
                                            <th class="text-center align-middle">
                                                Kode Klasifikasi
                                            </th>
                                            <th class="text-center align-middle" style="width: 550px;">
                                                Uraian
                                            </th>
                                            <th class="text-center align-middle">
                                                Tahun Pembuatan
                                            </th>
                                            <th class="text-center align-middle">
                                                Jenis Arsip
                                            </th>
                                            <th class="text-center align-middle">
                                                Sub Jenis Arsip
                                            </th>
                                            <th class="text-center align-middle">
                                                Status Arsip
                                            </th>
                                            <th class="text-center align-middle">
                                                Periode
                                            </th>
                                            @can('super-admin')
                                            <th class="text-center align-middle">
                                                File
                                            </th>
                                            @endcan
                                            @auth
                                            <th class="text-center align-middle" style="width: 100px;">
                                                Action
                                            </th>
                                            @endauth
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
    @can('super-admin')
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
    @endcan

    <!-- Modal Upload File -->
    <div class="modal fade" id="uploadFileModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="upload-file-form">
                @csrf

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Upload File Arsip
                        </h5>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden"
                            id="archive-id">

                        <input type="hidden"
                            id="upload-url">

                        <div class="mb-3">
                            <label class="form-label">
                                File PDF / Gambar
                            </label>

                            <input type="file"
                                id="archive-file"
                                class="form-control"
                                accept=".pdf,.jpg,.jpeg,.png">
                        </div>

                        <small class="text-muted">
                            Maksimal 50 MB
                        </small>

                    </div>

                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-primary">
                            Upload
                        </button>
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
                searching: false,
                ajax: {
                    url: "{{ route('archive-index') }}",
                    data: function (d) {
                        d.work_team_classification = $('#filterWorkTeamClassification').val();
                        d.archive_status= $('#filterArchiveStatus').val();
                        d.archive_type= $('#filterArchiveType').val();
                        d.archive_subtype= $('#filterArchiveSubType').val();
                        d.archive_lifespan = $('#filterLifespan').val();
                        d.period = $('#filterPeriod').val();
                        d.year_period = $('#filterYearPeriod').val();
                        d.textSearch = $('#text_search').val();
                    }
                },
                columns: [
                    @can('super-admin')   
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        width: '1%',
                        render: function (data) {
                            return `<input type="checkbox" class="row-checkbox" value="${data}" style="margin:0; transform: scale(1.2); vertical-align: middle;">`;
                        }
                    },
                    @endcan
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
                    // { data: 'period_name', name: 'period_name' },
                    // { data: 'year_period', name: 'year_period_name' },
                    { data: 'archive_type', name: 'archive_type_name' },
                    { data: 'archive_subtype', name: 'archive_subtype_name' },
                    { data: 'archive_status', name: 'archive_status_name' },
                    { data: 'period', name: 'period' },
                    @can('super-admin')
                        { data: 'file_upload', name: 'file_upload'},
                    @endcan
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
                $('#bulk-delete-btn').prop('disabled', !anyChecked);
            }

            // Tampilkan modal
            $('#bulk-edit-btn').on('click', function () {
                $('#bulkEditModal').modal('show');
            });

            // Submit Bulk Edit Form
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

            // Submit Bulk Delete
            $('#bulk-delete-btn').on('click', function () {
                const selectedIDs = $('.row-checkbox:checked').map(function () {
                return this.value;
            }).get();

            if (selectedIDs.length === 0) {
                Swal.fire('Peringatan', 'Pilih arsip yang ingin dihapus.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Yakin ingin menghapus arsip terpilih?',
                text: "Tindakan ini tidak bisa dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('archive-bulk-delete') }}",
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                ids: selectedIDs
                            },
                            success: function (response) {
                                $('#archives-table').DataTable().ajax.reload(function () {
                                    $('#select-all').prop('checked', false);
                                    lastChecked = null;
                                    toggleBulkButton();
                                }, false);
                                Swal.fire('Berhasil', response.message, 'success');
                            },
                            error: function () {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus arsip.', 'error');
                            }
                        });
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
            $('#filterArchiveType').change(function () { table.draw(); });
            $('#filterArchiveSubType').change(function () { table.draw(); });
            $('#filterArchiveStatus').change(function () { table.draw(); });
            $('#filterPeriod').change(function () { table.draw(); });
            $('#filterYearPeriod').change(function () { table.draw(); });
            $('#filterLifespan').change(function () { table.draw(); });
            $('#text_search').on('keyup', function () {table.draw();}); 
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

    <!-- Catch data value from dashboard -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const statusParam = urlParams.get('status');
            const typeParam = urlParams.get('archive_type');
            const subTypeParam = urlParams.get('archive_subtype');

            if (statusParam) {
                const select = document.getElementById('filterArchiveStatus');
                select.value = statusParam;

                // Trigger change event ke DataTable yg benar
                $('#filterArchiveStatus').trigger('change');
            }

            if (typeParam) {
                const select = document.getElementById('filterArchiveType');
                select.value = typeParam;

                // Trigger change event ke DataTable yg benar
                $('#filterArchiveType').trigger('change');
            }

            if (subTypeParam) {
                const select = document.getElementById('filterArchiveSubType');
                select.value = subTypeParam;

                // Trigger change event ke DataTable yg benar
                $('#filterArchiveSubType').trigger('change');
            }
        });

    </script>

    <script>
        $(document).on('click', '.btn-upload-file', function (e) {

            e.preventDefault();

            $('#archive-id').val($(this).data('archive-id'));
            $('#upload-url').val($(this).data('upload-url'));

            $('#archive-file').val('');

            $('#uploadFileModal').modal('show');
        });

        $('#upload-file-form').on('submit', function (e) {

            e.preventDefault();

            const file = $('#archive-file')[0].files[0];

            if (!file) {
                Swal.fire(
                    'Peringatan',
                    'Pilih file terlebih dahulu.',
                    'warning'
                );
                return;
            }

            const formData = new FormData();

            formData.append('file', file);

            $.ajax({
                url: $('#upload-url').val(),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content')
                },

                success: function (response) {

                    $('#uploadFileModal').modal('hide');

                    $('#archives-table')
                        .DataTable()
                        .ajax
                        .reload(null, false);

                    Swal.fire(
                        'Berhasil',
                        response.message,
                        'success'
                    );
                },

                error: function (xhr) {

                    Swal.fire(
                        'Gagal',
                        xhr.responseJSON?.message ??
                        'Upload gagal.',
                        'error'
                    );
                }
            });
        });
    </script>

@endpush