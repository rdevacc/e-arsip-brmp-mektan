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
                            <h5 class="card-title px-5">Edit Data Arsip</h5>

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
                            <form method="POST" action="{{ route('archive-edit-submit', $archive->id) }}">
                                @csrf
                                @method('PUT')
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
                                                    @if (old('work_unit_id', $archive->work_unit_id) == $workUnit->id)
                                                        <option value="{{ $workUnit->id }}" selected>
                                                            {{ $workUnit->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $workUnit->id }}">{{ $workUnit->name }}</option>
                                                    @endif
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
                                                    <option value="{{ $workGroup->id }}"
                                                        {{ old('work_group_id', $archive->work_group_id) == $workGroup->id ? 'selected' : '' }}>
                                                        {{ $workGroup->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('work_group_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="work_team_id" class="col-sm-3 col-form-label">Tim Kerja <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select disabled name="work_team_id" id="work_team_id"
                                                class="form-select bg-highlight @error('work_team_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Tim Kerja</option>
                                                @foreach ($workTeams as $workTeam)
                                                    <option value="{{ $workTeam->id }}"
                                                        {{ old('work_team_id', $archive->work_team_id) == $workTeam->id ? 'selected' : '' }}>
                                                        {{ $workTeam->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('work_team_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="work_team_classification_id" class="col-sm-3 form-label">Klasifikasi Tim Kerja <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="work_team_classification_id" id="work_team_classification_id"
                                                class="form-select bg-highlight @error('work_team_classification_id') is-invalid @enderror" style="width: 100%;">
                                                <option selected disabled>Pilih Klasifikasi Tim Kerja</option>
                                                @foreach ($workTeamClassifications as $workTeamClassification)
                                                    @if (old('work_team_classification_id', $archive->work_team_classification_id) == $workTeamClassification->id)
                                                        <option value="{{ $workTeamClassification->id }}" selected>
                                                            {{ $workTeamClassification->code }} - {{ $workTeamClassification->name }} 
                                                        </option>
                                                    @else
                                                        <option value="{{ $workTeamClassification->id }}">{{ $workTeamClassification->code }} - {{ $workTeamClassification->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('work_team_classification_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_classification_description" class="col-sm-3 form-label">Keterangan Klasifikasi</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control bg-highlight @error('archive_classification_description') is-invalid @enderror"
                                            id="archive_classification_description"
                                            name="archive_classification_description"
                                            placeholder="Isi Keterangan Klasifikasi">{{ $archive->archive_classification_description ?:old('archive_classification_description') }}</textarea>
                                            @error('archive_classification_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_retention_id" class="col-sm-3 form-label">Retensi Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_retention_id" id="archive_retention_id"
                                                class="form-select bg-highlight @error('archive_retention_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Retensi Arsip</option>
                                                @foreach ($archiveRetentions as $archiveRetention)
                                                    @if (old('archive_retention_id', $archive->archive_retention_id ) == $archiveRetention->id)
                                                        <option value="{{ $archiveRetention->id }}"  selected>
                                                            {{ $archiveRetention->range }} Tahun
                                                        </option>
                                                    @else
                                                        <option value="{{ $archiveRetention->id }}">{{ $archiveRetention->range }} Tahun</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('archive_retention_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_type_id" class="col-sm-3 form-label">Tipe Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_type_id" id="archive_type_id"
                                                class="form-select bg-highlight @error('archive_type_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Tipe Arsip</option>
                                                @foreach ($archiveTypes as $archiveType)
                                                    @if (old('archive_type_id', $archive->archive_type_id) == $archiveType->id)
                                                        <option value="{{ $archiveType->id }}" selected>
                                                            {{ $archiveType->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $archiveType->id }}">{{ $archiveType->name }}</option>
                                                    @endif
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
                                        <label for="archive_subtype_id" class="col-sm-3 form-label">SubTipe Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_subtype_id" id="archive_subtype_id"
                                                class="form-select bg-highlight @error('archive_subtype_id') is-invalid @enderror">
                                                <option selected disabled>Pilih SubTipe Arsip</option>
                                                @foreach ($archiveSubTypes as $archiveSubType)
                                                    @if (old('archive_subtype_id', $archive->archive_subtype_id) == $archiveSubType->id)
                                                        <option value="{{ $archiveSubType->id }}" selected>
                                                            {{ $archiveSubType->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $archiveSubType->id }}">{{ $archiveSubType->name }}</option>
                                                    @endif
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
                                        <label for="archive_status_id" class="col-sm-3 form-label">Status Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_status_id" id="archive_status_id"
                                                class="form-select bg-highlight @error('archive_status_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Status Arsip</option>
                                                @foreach ($archiveStatuses as $archiveStatus)
                                                    @if (old('archive_status_id', $archive->archive_status_id) == $archiveStatus->id)
                                                        <option value="{{ $archiveStatus->id }}" selected>
                                                            {{ $archiveStatus->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $archiveStatus->id }}">{{ $archiveStatus->name }}</option>
                                                    @endif
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
                                        <label for="archive_letter_origin_number" class="col-sm-3 form-label">Nomor Asal Surat <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control bg-highlight @error('archive_letter_origin_number') is-invalid @enderror"
                                                id="archive_letter_origin_number" name="archive_letter_origin_number"
                                                value="{{ $archive->archive_letter_origin_number ?: old('archive_letter_origin_number')}}">
                                            @error('archive_letter_origin_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_description" class="col-sm-3 form-label">Uraian Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control bg-highlight @error('archive_description') is-invalid @enderror"
                                                id="archive_description" name="archive_description"
                                                value="{{ $archive->archive_description ?:old('archive_description') }}">
                                            @error('archive_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_lifespan" class="col-sm-3 form-label">Kurun Waktu Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control bg-highlight @error('archive_lifespan') is-invalid @enderror"
                                                id="archive_lifespan" name="archive_lifespan"
                                                value="{{ $archive->archive_lifespan ?:old('archive_lifespan') }}">
                                            @error('archive_lifespan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_development_level_id" class="col-sm-3 form-label">Tingkat Perkembangan Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_development_level_id" id="archive_development_level_id"
                                                class="form-select bg-highlight @error('archive_development_level_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Tingkat Perkembangan Arsip</option>
                                                @foreach ($archiveDevelopmentLevels as $archiveDevelopmentLevel)
                                                    @if (old('archive_development_level_id', $archive->archive_development_level_id) == $archiveDevelopmentLevel->id)
                                                        <option value="{{ $archiveDevelopmentLevel->id }}" selected>
                                                            {{ $archiveDevelopmentLevel->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $archiveDevelopmentLevel->id }}">{{ $archiveDevelopmentLevel->name }}</option>
                                                    @endif
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
                                        <label for="archive_media_id" class="col-sm-3 form-label">Media Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_media_id" id="archive_media_id"
                                                class="form-select bg-highlight @error('archive_media_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Media Arsip</option>
                                                @foreach ($archiveMedias as $archiveMedia)
                                                    @if (old('archive_media_id', $archive->archive_media_id) == $archiveMedia->id)
                                                        <option value="{{ $archiveMedia->id }}" selected>
                                                            {{ $archiveMedia->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $archiveMedia->id }}">{{ $archiveMedia->name }}</option>
                                                    @endif
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
                                        <label for="archive_condition_id" class="col-sm-3 form-label">Kondisi Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_condition_id" id="archive_condition_id"
                                                class="form-select bg-highlight @error('archive_condition_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Kondisi Arsip</option>
                                                @foreach ($archiveConditions as $archiveCondition)
                                                    @if (old('archive_condition_id', $archive->archive_condition_id) == $archiveCondition->id)
                                                        <option value="{{ $archiveCondition->id }}" selected>
                                                            {{ $archiveCondition->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $archiveCondition->id }}">{{ $archiveCondition->name }}</option>
                                                    @endif
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
                                        <label for="archive_number" class="col-sm-3 form-label">Jumlah Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2 mb-2 mb-md-0">
                                                    <input type="text" class="form-control bg-highlight @error('archive_number') is-invalid @enderror"
                                                    id="archive_number" name="archive_number"
                                                    value="{{ $archive->archive_number ?: old('archive_number') }}">
                                                    @error('archive_number')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-10 mb-2 mb-md-0">
                                                    <select name="archive_quantity_unit_id" id="archive_quantity_unit_id"
                                                        class="form-select bg-highlight @error('archive_quantity_unit_id') is-invalid @enderror">
                                                        <option selected disabled>Pilih Unit Kuantitas</option>
                                                        @foreach ($archiveQuantityUnits as $archiveQuantityUnit)
                                                            @if (old('archive_quantity_unit_id', $archive->archive_quantity_unit_id) == $archiveQuantityUnit->id)
                                                                <option value="{{ $archiveQuantityUnit->id }}" selected>
                                                                    {{ $archiveQuantityUnit->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $archiveQuantityUnit->id }}">{{ $archiveQuantityUnit->name }}</option>
                                                            @endif
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
                                        <label for="archive_final_depreciation_action_id" class="col-sm-3 form-label">Tindakan Penyusutan Akhir Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_final_depreciation_action_id" id="archive_final_depreciation_action_id"
                                                class="form-select bg-highlight @error('archive_final_depreciation_action_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Tindakan Penyusutan Akhir Arsip</option>
                                                @foreach ($archiveFinalDepreciationActions as $archiveFinalDepreciationAction)
                                                    @if (old('archive_final_depreciation_action_id', $archive->archive_final_depreciation_action_id) == $archiveFinalDepreciationAction->id)
                                                        <option value="{{ $archiveFinalDepreciationAction->id }}" selected>
                                                            {{ $archiveFinalDepreciationAction->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $archiveFinalDepreciationAction->id }}">{{ $archiveFinalDepreciationAction->name }}</option>
                                                    @endif
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
                                        <label for="archive_security_classification_id" class="col-sm-3 form-label">Klasifikasi Keamanan Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_security_classification_id" id="archive_security_classification_id"
                                                class="form-select bg-highlight @error('archive_security_classification_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Klasifikasi Keamanan Arsip</option>
                                                @foreach ($archiveSecurityClassifications as $archiveSecurityClassification)
                                                    @if (old('archive_security_classification_id', $archive->archive_security_classification_id) == $archiveSecurityClassification->id)
                                                        <option value="{{ $archiveSecurityClassification->id }}" selected>
                                                            {{ $archiveSecurityClassification->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $archiveSecurityClassification->id }}">{{ $archiveSecurityClassification->name }}</option>
                                                    @endif
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
                                        <label for="archive_public_access_level_id" class="col-sm-3 form-label">Tingkat Akses Publik Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_public_access_level_id" id="archive_public_access_level_id"
                                                class="form-select bg-highlight @error('archive_public_access_level_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Tingkat Akses Publik Arsip</option>
                                                @foreach ($archivePublicAccessLevels as $archivePublicAccessLevel)
                                                    @if (old('archive_public_access_level_id', $archive->archive_public_access_level_id) == $archivePublicAccessLevel->id)
                                                        <option value="{{ $archivePublicAccessLevel->id }}" selected>
                                                            {{ $archivePublicAccessLevel->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $archivePublicAccessLevel->id }}">{{ $archivePublicAccessLevel->name }}</option>
                                                    @endif
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
                                        <label for="archive_access_level_id" class="col-sm-3 form-label">Akses Level Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="archive_access_level_id" id="archive_access_level_id"
                                                class="form-select bg-highlight @error('archive_access_level_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Akses Level Arsip</option>
                                                @foreach ($archiveAccessLevels as $archiveAccessLevel)
                                                    @if (old('archive_access_level_id', $archive->archive_access_level_id) == $archiveAccessLevel->id)
                                                        <option value="{{ $archiveAccessLevel->id }}" selected>
                                                            {{ $archiveAccessLevel->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $archiveAccessLevel->id }}">{{ $archiveAccessLevel->name }}</option>
                                                    @endif
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
                                        <label for="archive_input_date" class="col-sm-3 form-label">Tanggal Input Arsip <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control bg-highlight @error('archive_input_date') is-invalid @enderror"
                                                id="archive_input_date" name="archive_input_date"
                                                value="{{ $archive->archive_input_date ?: old('archive_input_date') }}">
                                            @error('archive_input_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="period_id" class="col-sm-3 form-label">Periode Arsip <span class="text-danger">*</span></label>
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
                                        <label for="archive_storage_location_id" class="col-sm-3 form-label">Lokasi Penyimpanan Arsip</label>
                                        <div class="col-sm-9">
                                            <select name="archive_storage_location_id" id="archive_storage_location_id"
                                                class="form-select bg-highlight @error('archive_storage_location_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Lokasi Penyimpanan Arsip</option>
                                                @foreach ($storageLocations as $storageLocation)
                                                    @if (old('archive_storage_location_id', $archive->archive_storage_location_id) == $storageLocation->id)
                                                        <option value="{{ $storageLocation->id }}" selected>
                                                            {{ $storageLocation->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $storageLocation->id }}">{{ $storageLocation->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('archive_storage_location_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_storage_place_id" class="col-sm-3 form-label">Tempat Penyimpanan Arsip</label>
                                        <div class="col-sm-9">
                                            <select name="archive_storage_place_id" id="archive_storage_place_id"
                                                class="form-select bg-highlight @error('archive_storage_place_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Tempat Penyimpanan Arsip</option>
                                                @foreach ($storagePlaces as $storagePlace)
                                                    @if (old('archive_storage_place_id', $archive->archive_storage_place_id) == $storagePlace->id)
                                                        <option value="{{ $storagePlace->id }}" selected>
                                                            {{ $storagePlace->name }} - {{ $storagePlace->archive_storage_location->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $storagePlace->id }}">{{ $storagePlace->name }} - {{ $storagePlace->archive_storage_location->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('archive_storage_place_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="archive_shelf_row_id" class="col-sm-3 form-label">Baris Rak Arsip</label>
                                        <div class="col-sm-9">
                                            <select name="archive_shelf_row_id" id="archive_shelf_row_id"
                                                class="form-select bg-highlight @error('archive_shelf_row_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Baris Rak Arsip</option>
                                                @foreach ($shelfRows as $shelfRow)
                                                @if (old('archive_shelf_row_id', $archive->archive_shelf_row_id) == $shelfRow->id)
                                                    <option value="{{ $shelfRow->id }}" selected>
                                                        {{ $shelfRow->name }} - {{ $shelfRow->archive_storage_place->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $shelfRow->id }}">{{ $shelfRow->name }} - {{ $shelfRow->archive_storage_place->name }}</option>
                                                @endif
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
                                        <label for="archive_box_id" class="col-sm-3 form-label">Box Arsip</label>
                                        <div class="col-sm-9">
                                            <select name="archive_box_id" id="archive_box_id"
                                                class="form-select bg-highlight @error('archive_box_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Box Arsip</option>
                                                @foreach ($boxes as $box)
                                                    @if (old('archive_box_id', $archive->archive_box_id) == $box->id)
                                                        <option value="{{ $box->id }}" selected>
                                                            {{ $box->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $box->id }}">{{ $box->name }}</option>
                                                    @endif
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
                                        <label for="archive_folder_id" class="col-sm-3 form-label">Folder Arsip</label>
                                        <div class="col-sm-9">
                                            <select name="archive_folder_id" id="archive_folder_id"
                                                class="form-select bg-highlight @error('archive_folder_id') is-invalid @enderror">
                                                <option selected disabled>Pilih Folder Arsip</option>
                                                @foreach ($folders as $folder)
                                                    @if (old('archive_folder_id', $archive->archive_folder_id) == $folder->id)
                                                        <option value="{{ $folder->id }}" selected>
                                                            {{ $folder->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('archive_folder_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Button --}}
                                <div class="mt-5 mb-2 me-2 text-end">
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('archive-index') }}'">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form><!-- Vertical Form -->
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
    document.addEventListener('DOMContentLoaded', () => {
        const workGroup = document.getElementById('work_group_id');
        const workTeam = document.getElementById('work_team_id');
        const form = workTeam.closest('form');

        workGroup.addEventListener('change', async () => {
            const id = workGroup.value;

            // Disable dropdown saat loading
            workTeam.disabled = true;
            workTeam.innerHTML = `<option selected disabled>Memuat Tim Kerja...</option>`;

            try {
                const response = await fetch(`/app/archive/work-teams/${id}`);
                const data = await response.json();

                // Isi ulang dan aktifkan dropdown
                workTeam.innerHTML = `<option selected disabled>Pilih Tim Kerja</option>`;
                data.forEach(item => {
                    workTeam.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });

                workTeam.disabled = false;
            } catch (err) {
                workTeam.innerHTML = `<option selected disabled>Gagal memuat data</option>`;
                workTeam.disabled = true;
            }
        });

        // Hapus 'disabled' sebelum form disubmit agar value ikut terkirim
        form.addEventListener('submit', () => {
            workTeam.disabled = false;
        });
    });
</script>
@endpush
