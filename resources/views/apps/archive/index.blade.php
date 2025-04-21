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
                            <h4 class="card-title">Data Seluruh Arsip</h4>

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
                                    <select id="filterWorkTeamClassification" class="form-control" style="width: 200px;">
                                        <option value="">Semua Kode Klasifikasi</option>
                                        @foreach($workTeamClassificationList as $workTeamClassification)
                                            <option value="{{ $workTeamClassification->name }}">{{ $workTeamClassification->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class="col-auto mb-2">
                                    <select id="filterMediaArsip" class="form-control" style="width: 200px;">
                                        <option value="">Semua Media</option>
                                        @foreach($mediaList as $media)
                                            <option value="{{ $media->name }}">{{ $media->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table id="archives-table" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th  rowspan="2" class="text-center align-middle">
                                                #
                                            </th>
                                            <th  rowspan="2" class="text-center align-middle">
                                                Unit Kerja
                                            </th>
                                            <th  rowspan="2" class="text-center align-middle">
                                                Kode Klasifikasi
                                            </th>
                                            <th  rowspan="2" class="text-center align-middle">
                                                Uraian
                                            </th>
                                           <th  rowspan="2" class="text-center align-middle">
                                                Kurun Waktu
                                            </th>
                                            <th  rowspan="2" class="text-center align-middle">
                                                Tingkat Perkembangan
                                            </th>
                                            <th  rowspan="2" class="text-center align-middle">
                                                Media Arsip
                                            </th>
                                            <th  rowspan="2" class="text-center align-middle">
                                                Kondisi Arsip
                                            </th>
                                            <th  rowspan="2" class="text-center align-middle">
                                                Jumlah Arsip
                                            </th>
                                            <th rowspan="1" colspan="6" class="text-center align-middle">Lokasi Penyimpanan  
                                            </th>                                            
                                            <th rowspan="2"class="text-center align-middle">
                                                Action
                                            </th>

                                        </tr>
                                        <tr>
                                            <th class="text-center align-middle">Gedung</th>
                                            <th class="text-center align-middle">Lemari</th>
                                            <th class="text-center align-middle">Rak</th>
                                            <th class="text-center align-middle">Baris</th>
                                            <th class="text-center align-middle">Boks</th>
                                            <th class="text-center align-middle">Folder</th>
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
    {{-- {{ $dataTable->scripts() }} --}}

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    
    <script>
        $(function () {
            var table = $('#archives-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('archive-index') }}",
                    data: function (d) {
                        d.work_team_classification = $('#filterWorkTeamClassification').val();
                        d.media_arsip = $('#filterMediaArsip').val();
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
                    { data: 'work_unit', name: 'work_unit' },
                    { data: 'work_team_classification', name: 'work_team_classification' },
                    { data: 'archive_description', name: 'archive_description' },
                    { data: 'archive_lifespan', name: 'archive_lifespan' },
                    { data: 'archive_development_level', name: 'archive_development_level' },
                    { data: 'archive_media', name: 'archive_media' },
                    { data: 'archive_condition', name: 'archive_condition' },
                    { data: 'archive_number', name: 'archive_number' },
                    { data: 'building', name: 'building' },
                    { data: 'cabinet', name: 'cabinet' },
                    { data: 'shelf', name: 'shelf' },
                    { data: 'shelf_row', name: 'shelf_row' },
                    { data: 'box', name: 'box' },
                    { data: 'folder', name: 'folder' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            $('#filterWorkTeamClassification').change(function () {
                table.draw(); // refresh DataTables saat filter berubah
            });

            $('#filterMediaArsip').change(function () {
                table.draw(); // refresh DataTables saat filter berubah
            });

        });
    </script>
@endpush