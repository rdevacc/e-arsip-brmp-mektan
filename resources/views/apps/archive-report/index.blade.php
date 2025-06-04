@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.0/r-3.0.0/datatables.min.css" rel="stylesheet">

    {{-- DataTable Button CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.bootstrap5.css">
@endpush

@section('content')
<main id="main" class="main">
    <section class="section archive-media">
        <div class="pagetitle">
            <h1>Cetak Laporan Arsip</h1>
        </div>

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

        <div class="card mb-4">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="input-group">
                        <input type="text" id="text_search" class="form-control" placeholder="Cari judul atau uraian arsip...">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" id="start_date" class="form-control" placeholder="Pilih tanggal mulai">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                        <input type="date" id="end_date" class="form-control" placeholder="Pilih tanggal akhir">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="archive_status" class="form-label">Status Arsip</label>
                        <select name="archive_status" id="archive_status" class="form-select">
                            <option selected value="">Pilih Status Arsip</option>
                            @foreach($archiveStatusList as $archiveStatus)
                                <option value="{{ $archiveStatus->id }}">{{ $archiveStatus->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="filterWorkTeamClassification" class="form-label">Kode Klasifikasi Arsip</label>
                        <select name="filterWorkTeamClassification" id="filterWorkTeamClassification" class="form-select">
                            <option selected value="">Pilih Kode Klasifikasi Arsip</option>
                            @foreach($workTeamClassificationList as $workTeamClassification)
                                <option value="{{ $workTeamClassification->id }}">{{ $workTeamClassification->code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="archive_lifespan" class="form-label">Kurun Waktu Arsip</label>
                        <select name="archive_lifespan" id="archive_lifespan" class="form-select">
                            <option selected value="">Pilih Kurun Waktu Arsip</option>
                            @foreach ($lifespanList as $lifespan)
                                <option value="{{ $lifespan }}">{{ $lifespan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div id="laporanCard" class="mt-3" style="display: none;">
                    <table id="laporanTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">#</th>
                                <th class="text-center align-middle">Kode Klasifikasi</th>
                                <th class="text-center align-middle" style="width: 250px;">Uraian</th>
                                <th class="text-center align-middle">Kurun Waktu</th>
                                <th class="text-center align-middle">Status Arsip</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    let table;

    function fetchLaporan() {
        const textSearch = $('#text_search').val();
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();
        const archiveStatus = $('#archive_status').val();
        const classification = $('#filterWorkTeamClassification').val();
        const lifespan = $('#archive_lifespan').val();

        console.log({
            textSearch, startDate, endDate, archiveStatus, classification, lifespan
        });

        if (!textSearch && !startDate && !endDate && !archiveStatus && !classification && !lifespan) {
            $('#laporanCard').hide();
            if ($.fn.DataTable.isDataTable('#laporanTable')) {
                $('#laporanTable').DataTable().clear().destroy();
            }
            return;
        }

        $('#laporanCard').show();

        if ($.fn.DataTable.isDataTable('#laporanTable')) {
            $('#laporanTable').DataTable().clear().destroy();
        }

        table = $('#laporanTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('archive-report.filter') }}",
                type: "GET",
                data: {
                    text_search: textSearch,
                    start_date: startDate,
                    end_date: endDate,
                    archive_status: archiveStatus,
                    classification: classification,
                    lifespan: lifespan
                },
                error: function (xhr, error, thrown) {
                    console.log(xhr.responseText);
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'classification_code', name: 'classification_code' },
                { data: 'description', name: 'description' },
                { data: 'lifespan', name: 'lifespan' },
                { data: 'status', name: 'status' }
            ]
        });
    }

    $('#text_search, #start_date, #end_date, #archive_status, #filterWorkTeamClassification, #archive_lifespan').on('change keyup', fetchLaporan);
});
</script>
@endpush
