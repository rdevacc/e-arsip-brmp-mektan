@extends('layouts.app')

@push('css')
    <style>
    .no-spinner::-webkit-outer-spin-button,
    .no-spinner::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .no-spinner[type=number] {
        -moz-appearance: textfield;
    }
    </style>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush

@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title px-5">Tambah Data Arsip</h5>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="pb-4">
                                    <div
                                        class="flex w-1/2 bg-green-800 rounded-md p-2 mx-auto text-center justify-center items-center">
                                        <span class="text-slate-100 align-middle">{{ session('success') }}</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Vertical Form -->
                            <form method="POST" action="{{ route('archive-create-submit') }}">
                                @csrf
                                <div class="row px-5">
                                    <input type="hidden" value="1" class="form-control bg-highlight" for="user_id" name="user_id"
                                        id="user_id">
                                    <div class="row mb-3">
                                        <label for="work_unit_id" class="col-sm-3 col-form-label">Unit Kerja <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="work_unit_id" id="work_unit_id"
                                                class="form-select bg-highlight @error('work_unit_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Unit Kerja</option>
                                                @foreach ($workUnits as $workUnit)
                                                    <option value="{{ $workUnit->id }}" @selected(old('work_unit_id') == $workUnit->id)>
                                                        {{ $workUnit->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('work_unit_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="work_group_id" class="col-sm-3 col-form-label">Kelompok Kerja <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="work_group_id" id="work_group_id"
                                            class="form-select bg-highlight @error('work_group_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Kelompok Kerja</option>
                                            @foreach ($workGroups as $workGroup)
                                                <option value="{{ $workGroup->id }}" @selected(old('work_group_id') == $workGroup->id)>
                                                    {{ $workGroup->name }}</option>
                                            @endforeach
                                            </select>
                                            @error('work_group_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="work_team_id" class="col-sm-3 col-form-label">Tim Kerja <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="work_team_id" id="work_team_id"
                                                class="form-select bg-highlight @error('work_team_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Kelompok Kerja terlebih dahulu</option>
                                            </select>
                                            @error('work_team_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="work_team_classification_id" class="col-sm-3 col-form-label">Kode Klasifikasi <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="work_team_classification_id" id="work_team_classification_id" class="form-select bg-highlight @error('work_team_classification_id') is-invalid @enderror" style="width: 100%;">
                                                <option value="">Pilih Kode Klasifikasi</option>
                                                @if (old('work_team_classification_id'))
                                                    <option value="{{ old('work_team_classification_id') }}" selected>
                                                        {{ old('work_team_classification_id_text') ?? session('old_work_team_classification_text') ?? 'Memuat...' }}
                                                    </option>
                                                @endif
                                            </select>
                                            @error('work_team_classification_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_classification_description" class="col-sm-3 col-form-label">Keterangan Klasifikasi</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control bg-highlight @error('archive_classification_description') is-invalid @enderror"
                                            id="archive_classification_description"
                                            name="archive_classification_description"
                                            placeholder="Isi Keterangan Klasifikasi">{{ old('archive_classification_description') ?: '' }}</textarea>
                                            @error('archive_classification_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_retention_id" class="col-sm-3 col-form-label">Retensi Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_retention_id" id="archive_retention_id"
                                                class="form-select bg-highlight @error('archive_retention_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Retensi Arsip</option>
                                                @foreach ($archiveRetentions as $archiveRetention)
                                                    <option value="{{ $archiveRetention->id }}" @selected(old('archive_retention_id') == $archiveRetention->id)>
                                                        {{ $archiveRetention->range_value }} Tahun</option>
                                                @endforeach
                                            </select>
                                            @error('archive_retention_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_type_id" class="col-sm-3 col-form-label">Tipe Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_type_id" id="archive_type_id"
                                                class="form-select bg-highlight @error('archive_type_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Tipe Arsip</option>
                                                @foreach ($archiveTypes as $archiveType)
                                                    <option value="{{ $archiveType->id }}" @selected(old('archive_type_id') == $archiveType->id)>
                                                        {{ $archiveType->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_type_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_subtype_id" class="col-sm-3 col-form-label">SubTipe Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_subtype_id" id="archive_subtype_id"
                                                class="form-select bg-highlight @error('archive_subtype_id') is-invalid @enderror">
                                                <option selected disabled>Pilih SubTipe Arsip</option>
                                                @foreach ($archiveSubTypes as $archiveSubType)
                                                    <option value="{{ $archiveSubType->id }}" @selected(old('archive_subtype_id') == $archiveSubType->id)>
                                                        {{ $archiveSubType->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_subtype_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_status_id" class="col-sm-3 col-form-label">Status Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_status_id" id="archive_status_id"
                                                class="form-select bg-highlight @error('archive_status_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Status Arsip</option>
                                                @foreach ($archiveStatuses as $archiveStatus)
                                                    <option value="{{ $archiveStatus->id }}" @selected(old('archive_status_id') == $archiveStatus->id)>
                                                        {{ $archiveStatus->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_status_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_letter_origin_number" class="col-sm-3 col-form-label">Nomor Asal Surat <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control bg-highlight @error('archive_letter_origin_number') is-invalid @enderror"
                                                id="archive_letter_origin_number" name="archive_letter_origin_number" value="{{ old('archive_letter_origin_number') ?: '' }}">
                                            @error('archive_letter_origin_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_description" class="col-sm-3 col-form-label">Uraian Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control bg-highlight @error('archive_description') is-invalid @enderror"
                                                id="archive_description" name="archive_description" value="{{ old('archive_description') ?: '' }}">
                                            @error('archive_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_lifespan" class="col-sm-3 col-form-label">Kurun Waktu Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control bg-highlight no-spinner @error('archive_lifespan') is-invalid @enderror"
                                                id="archive_lifespan" name="archive_lifespan" value="{{ old('archive_lifespan') ?: '' }}">
                                            @error('archive_lifespan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_development_level_id" class="col-sm-3 col-form-label">Tingkat Perkembangan Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_development_level_id" id="archive_development_level_id"
                                                class="form-select bg-highlight @error('archive_development_level_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Tingkat Perkembangan Arsip</option>
                                                @foreach ($archiveDevelopmentLevels as $archiveDevelopmentLevel)
                                                    <option value="{{ $archiveDevelopmentLevel->id }}" @selected(old('archive_development_level_id') == $archiveDevelopmentLevel->id)>
                                                        {{ $archiveDevelopmentLevel->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_development_level_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_media_id" class="col-sm-3 col-form-label">Media Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_media_id" id="archive_media_id"
                                                class="form-select bg-highlight @error('archive_media_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Media Arsip</option>
                                                @foreach ($archiveMedias as $archiveMedia)
                                                    <option value="{{ $archiveMedia->id }}" @selected(old('archive_media_id') == $archiveMedia->id)>
                                                        {{ $archiveMedia->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_media_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_condition_id" class="col-sm-3 col-form-label">Kondisi Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_condition_id" id="archive_condition_id"
                                                class="form-select bg-highlight @error('archive_condition_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Kondisi Arsip</option>
                                                @foreach ($archiveConditions as $archiveCondition)
                                                    <option value="{{ $archiveCondition->id }}" @selected(old('archive_condition_id') == $archiveCondition->id)>
                                                        {{ $archiveCondition->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_condition_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_number" class="col-sm-3 col-form-label">Jumlah Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-4 mb-2 mb-md-0">
                                                    <input type="text" placeholder="Masukkan Jumlah Asrip" class="form-control bg-highlight @error('archive_number') is-invalid @enderror"
                                                    id="archive_number" name="archive_number" value="{{ old('archive_number') ?: '' }}">
                                                    @error('archive_number')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-8 mb-2 mb-md-0">
                                                    <select name="archive_quantity_unit_id" id="archive_quantity_unit_id"
                                                        class="form-select bg-highlight @error('archive_quantity_unit_id') is-invalid @enderror">
                                                        <option selected disabled>Pilih Unit Kuantitas</option>
                                                        @foreach ($archiveQuantityUnits as $archiveQuantityUnit)
                                                            <option value="{{ $archiveQuantityUnit->id }}" @selected(old('archive_quantity_unit_id') == $archiveQuantityUnit->id)>
                                                                {{ $archiveQuantityUnit->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('archive_quantity_unit_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_final_depreciation_action_id" class="col-sm-3 col-form-label">Tindakan Penyusutan Akhir <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_final_depreciation_action_id" id="archive_final_depreciation_action_id"
                                                class="form-select bg-highlight @error('archive_final_depreciation_action_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Tindakan Penyusutan Akhir Arsip</option>
                                                @foreach ($archiveFinalDepreciationActions as $archiveFinalDepreciationAction)
                                                    <option value="{{ $archiveFinalDepreciationAction->id }}" @selected(old('archive_final_depreciation_action_id') == $archiveFinalDepreciationAction->id)>
                                                        {{ $archiveFinalDepreciationAction->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_final_depreciation_action_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_security_classification_id" class="col-sm-3 col-form-label">Klasifikasi Keamanan Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_security_classification_id" id="archive_security_classification_id"
                                                class="form-select bg-highlight @error('archive_security_classification_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Klasifikasi Keamanan Arsip</option>
                                                @foreach ($archiveSecurityClassifications as $archiveSecurityClassification)
                                                    <option value="{{ $archiveSecurityClassification->id }}" @selected(old('archive_security_classification_id') == $archiveSecurityClassification->id)>
                                                        {{ $archiveSecurityClassification->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_security_classification_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_public_access_level_id" class="col-sm-3 col-form-label">Tingkat Akses Publik Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_public_access_level_id" id="archive_public_access_level_id"
                                                class="form-select bg-highlight @error('archive_public_access_level_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Tingkat Akses Publik Arsip</option>
                                                @foreach ($archivePublicAccessLevels as $archivePublicAccessLevel)
                                                    <option value="{{ $archivePublicAccessLevel->id }}" @selected(old('archive_public_access_level_id') == $archivePublicAccessLevel->id)>
                                                        {{ $archivePublicAccessLevel->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_public_access_level_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_access_level_id" class="col-sm-3 col-form-label">Akses Level Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_access_level_id" id="archive_access_level_id"
                                                class="form-select bg-highlight @error('archive_access_level_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Akses Level Arsip</option>
                                                @foreach ($archiveAccessLevels as $archiveAccessLevel)
                                                    <option value="{{ $archiveAccessLevel->id }}" @selected(old('archive_access_level_id') == $archiveAccessLevel->id)>
                                                        {{ $archiveAccessLevel->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_access_level_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_input_date" class="col-sm-3 col-form-label">Tanggal Input Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control bg-highlight @error('archive_input_date') is-invalid @enderror"
                                                id="archive_input_date" name="archive_input_date" value="{{ old('archive_input_date') ?: '' }}">
                                            @error('archive_input_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="period_id" class="col-sm-3 col-form-label">Periode Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-4 mb-2 mb-md-0">
                                                    <select name="period_id" id="period_id"
                                                        class="form-select bg-highlight @error('period_id') is-invalid @enderror">
                                                        <option selected disabled>Pilih Periode</option>
                                                        @foreach ($periods as $period)
                                                            <option value="{{ $period->id }}" @selected(old('period_id') == $period->id)>
                                                                {{ $period->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('period_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-8 mb-2 mb-md-0">
                                                    <input type="text" placeholder="Masukkan Tahun Periode" class="form-control bg-highlight @error('year_period') is-invalid @enderror"
                                                    id="year_period" name="year_period" value="{{ old('year_period') ?: '' }}">
                                                    @error('year_period')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="card-title">Lokasi Penyimpanan Arsip</h5>

                                    <div class="row mb-3">
                                        <label for="archive_building_id" class="col-sm-3 col-form-label">Gedung Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_building_id" id="archive_building_id"
                                                class="form-select bg-highlight @error('archive_building_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Gedung Arsip</option>
                                                @foreach ($buildings as $building)
                                                    <option value="{{ $building->id }}" @selected(old('archive_building_id') == $building->id)>
                                                        {{ $building->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_building_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_cabinet_id" class="col-sm-3 col-form-label">Lemari Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_cabinet_id" id="archive_cabinet_id"
                                                class="form-select bg-highlight @error('archive_cabinet_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Lemari Arsip</option>
                                                @foreach ($cabinets as $cabinet)
                                                    <option value="{{ $cabinet->id }}" @selected(old('archive_cabinet_id') == $cabinet->id)>
                                                        {{ $cabinet->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_cabinet_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_shelf_id" class="col-sm-3 col-form-label">Rak Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_shelf_id" id="archive_shelf_id"
                                                class="form-select bg-highlight @error('archive_shelf_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Rak Arsip</option>
                                                @foreach ($shelves as $shelf)
                                                    <option value="{{ $shelf->id }}" @selected(old('archive_shelf_id') == $shelf->id)>
                                                        {{ $shelf->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_shelf_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_shelf_row_id" class="col-sm-3 col-form-label">Baris Rak Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_shelf_row_id" id="archive_shelf_row_id"
                                                class="form-select bg-highlight @error('archive_shelf_row_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Baris Rak Arsip</option>
                                                @foreach ($shelfRows as $shelfRow)
                                                    <option value="{{ $shelfRow->id }}" @selected(old('archive_shelf_row_id') == $shelfRow->id)>
                                                        {{ $shelfRow->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_shelf_row_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_box_id" class="col-sm-3 col-form-label">Box Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_box_id" id="archive_box_id"
                                                class="form-select bg-highlight @error('archive_box_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Box Arsip</option>
                                                @foreach ($boxes as $box)
                                                    <option value="{{ $box->id }}" @selected(old('archive_box_id') == $box->id)>
                                                        {{ $box->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_box_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_folder_id" class="col-sm-3 col-form-label">Folder Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_folder_id" id="archive_folder_id"
                                                class="form-select bg-highlight @error('archive_folder_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Folder Arsip</option>
                                                @foreach ($folders as $folder)
                                                    <option value="{{ $folder->id }}" @selected(old('archive_folder_id') == $folder->id)>
                                                        {{ $folder->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('archive_folder_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                <!-- Button -->
                                <div class="mt-5 mb-2 me-2 text-end">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <!-- Vertical Form -->
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
@endsection

@push('scripts')

<script>
    $('#work_team_classification_id').select2({
        theme: 'bootstrap-5',
        placeholder: 'Pilih Kode Klasifikasi',
        ajax: {
            url: "{{ route('work_team_classifications.search') }}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return { q: params.term };
            },
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.code + ' - ' + item.name
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 1,
    });
</script>

<script>
    async function loadOptions(url, targetSelect, placeholder, labelKey = 'name') {
        targetSelect.innerHTML = `<option selected disabled>Loading...</option>`;
        try {
            const res = await fetch(url);
            const data = await res.json();

            targetSelect.innerHTML = `<option selected disabled>${placeholder}</option>`;
            data.forEach(item => {
                targetSelect.innerHTML += `<option value="${item.id}">${item[labelKey]}</option>`;
            });
        } catch (err) {
            targetSelect.innerHTML = `<option selected disabled>Gagal memuat data</option>`;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const workGroup = document.getElementById('work_group_id');
        const workTeam = document.getElementById('work_team_id');

        workGroup.addEventListener('change', () => {
            const id = workGroup.value;
            loadOptions(`/app/archive/work-teams/${id}`, workTeam, 'Pilih Tim Kerja', 'name');
            // jika variabel classification ada, harus diinisialisasi dulu, atau ubah sesuai id/select element sebenarnya
            // classification.innerHTML = `<option selected disabled>Pilih Tim Kerja terlebih dahulu</option>`;
        });
    });
</script>

@endpush
