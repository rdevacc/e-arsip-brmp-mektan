@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Data Arsip</h5>

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
                                <div class="row">
                                    <input type="hidden" value="1" class="form-control" for="user_id" name="user_id"
                                        id="user_id">
                                    <div class="col-12 mb-3">
                                        <label for="work_unit_id" class="form-label">Unit Kerja</label>
                                        <select name="work_unit_id" id="work_unit_id"
                                            class="form-select @error('work_unit_id') is-invalid @enderror">
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
                                    <div class="col-12 mb-3">
                                        <label for="work_group_id" class="form-label">Kelompok Kerja</label>
                                        <select name="work_group_id" id="work_group_id"
                                            class="form-select @error('work_group_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Kelompok Kerja</option>
                                            @foreach ($workGroups as $workGroup)
                                                @if (old('work_group_id', $archive->work_group_id) == $workGroup->id)
                                                    <option value="{{ $workGroup->id }}" selected>
                                                        {{ $workGroup->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $workGroup->id }}">{{ $workGroup->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('work_group_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="work_team_id" class="form-label">Tim Kerja</label>
                                        <select name="work_team_id" id="work_team_id"
                                            class="form-select @error('work_team_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Tim Kerja</option>
                                            @foreach ($workTeams as $workTeam)
                                                @if (old('work_team_id', $archive->work_team_id) == $workTeam->id)
                                                    <option value="{{ $workTeam->id }}" selected>
                                                        {{ $workTeam->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $workTeam->id }}">{{ $workTeam->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('work_team_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="work_team_classification_id" class="form-label">Klasifikasi Tim Kerja</label>
                                        <select name="work_team_classification_id" id="work_team_classification_id"
                                            class="form-select @error('work_team_classification_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Klasifikasi Tim Kerja</option>
                                            @foreach ($workTeamClassifications as $workTeamClassification)
                                                @if (old('work_team_classification_id', $archive->work_team_classification_id) == $workTeamClassification->id)
                                                    <option value="{{ $workTeamClassification->id }}" selected>
                                                        {{ $workTeamClassification->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $workTeamClassification->id }}">{{ $workTeamClassification->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('work_team_classification_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="archive_description" class="form-label">Keterangan Klasifikasi</label>
                                        <textarea class="form-control @error('archive_description') is-invalid @enderror"
                                        id="archive_description"
                                        name="archive_description"
                                        placeholder="Isi Keterangan Klasifikasi">{{ $archive->archive_description ?:old('archive_description') }}</textarea>
                                        @error('archive_description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="archive_retention_id" class="form-label">Retensi Arsip</label>
                                        <select name="archive_retention_id" id="archive_retention_id"
                                            class="form-select @error('archive_retention_id') is-invalid @enderror">
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
                                        @error('archive_retention_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="archive_type_id" class="form-label">Tipe Arsip</label>
                                        <select name="archive_type_id" id="archive_type_id"
                                            class="form-select @error('archive_type_id') is-invalid @enderror">
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
                                    <div class="col-12 mb-3">
                                        <label for="archive_status_id" class="form-label">Status Arsip</label>
                                        <select name="archive_status_id" id="archive_status_id"
                                            class="form-select @error('archive_status_id') is-invalid @enderror">
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
                                    <div class="col-12 mb-3">
                                        <label for="archive_letter_origin_number" class="form-label">Nomor Asal Surat</label>
                                        <input type="text" class="form-control @error('archive_letter_origin_number') is-invalid @enderror"
                                            id="archive_letter_origin_number" name="archive_letter_origin_number"
                                            value="{{ $archive->archive_letter_origin_number ?: old('archive_letter_origin_number')}}">
                                        @error('archive_letter_origin_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="archive_description" class="form-label">Uraian Arsip</label>
                                        <input type="text" class="form-control @error('archive_description') is-invalid @enderror"
                                            id="archive_description" name="archive_description"
                                            value="{{ $archive->archive_description ?:old('archive_description') }}">
                                        @error('archive_description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="archive_lifespan" class="form-label">Kurun Waktu Arsip</label>
                                        <input type="text" class="form-control @error('archive_lifespan') is-invalid @enderror"
                                            id="archive_lifespan" name="archive_lifespan"
                                            value="{{ $archive->archive_lifespan ?:old('archive_lifespan') }}">
                                        @error('archive_lifespan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="archive_development_level_id" class="form-label">Tingkat Perkembangan Arsip</label>
                                        <select name="archive_development_level_id" id="archive_development_level_id"
                                            class="form-select @error('archive_development_level_id') is-invalid @enderror">
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
                                    <div class="col-12 mb-3">
                                        <label for="archive_media_id" class="form-label">Media Arsip</label>
                                        <select name="archive_media_id" id="archive_media_id"
                                            class="form-select @error('archive_media_id') is-invalid @enderror">
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
                                    <div class="col-12 mb-3">
                                        <label for="archive_condition_id" class="form-label">Kondisi Arsip</label>
                                        <select name="archive_condition_id" id="archive_condition_id"
                                            class="form-select @error('archive_condition_id') is-invalid @enderror">
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
                                    <div class="col-12 mb-3">
                                        <label for="archive_number" class="form-label">Jumlah Arsip</label>
                                        <div class="row">
                                            <div class="col-md-2 mb-2 mb-md-0">
                                                <input type="text" class="form-control @error('archive_number') is-invalid @enderror"
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
                                                    class="form-select @error('archive_quantity_unit_id') is-invalid @enderror">
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
                                    <div class="col-12 mb-3">
                                        <label for="archive_final_depreciation_action_id" class="form-label">Tindakan Penyusutan Akhir Arsip</label>
                                        <select name="archive_final_depreciation_action_id" id="archive_final_depreciation_action_id"
                                            class="form-select @error('archive_final_depreciation_action_id') is-invalid @enderror">
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
                                    <div class="col-12 mb-3">
                                        <label for="archive_security_classification_id" class="form-label">Klasifikasi Keamanan Arsip</label>
                                        <select name="archive_security_classification_id" id="archive_security_classification_id"
                                            class="form-select @error('archive_security_classification_id') is-invalid @enderror">
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
                                    <div class="col-12 mb-3">
                                        <label for="archive_public_access_level_id" class="form-label">Tingkat Akses Publik Arsip</label>
                                        <select name="archive_public_access_level_id" id="archive_public_access_level_id"
                                            class="form-select @error('archive_public_access_level_id') is-invalid @enderror">
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
                                    <div class="col-12 mb-3">
                                        <label for="archive_access_level_id" class="form-label">Akses Level Arsip</label>
                                        <select name="archive_access_level_id" id="archive_access_level_id"
                                            class="form-select @error('archive_access_level_id') is-invalid @enderror">
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
                                    <div class="col-12 mb-3">
                                        <label for="archive_input_date" class="form-label">Tanggal Input Arsip</label>
                                        <input type="date" class="form-control @error('archive_input_date') is-invalid @enderror"
                                            id="archive_input_date" name="archive_input_date"
                                            value="{{ $archive->archive_input_date ?: old('archive_input_date') }}">
                                        @error('archive_input_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <h5 class="card-title">Lokasi Penyimpanan Arsip</h5>

                                    <div class="col-12 mb-3">
                                        <label for="building_id" class="form-label">Gedung Arsip</label>
                                        <select name="building_id" id="building_id"
                                            class="form-select @error('building_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Gedung Arsip</option>
                                            @foreach ($buildings as $building)
                                                @if (old('building_id', $archive->building_id) == $building->id)
                                                    <option value="{{ $building->id }}" selected>
                                                        {{ $building->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('building_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="cabinet_id" class="form-label">Lemari Arsip</label>
                                        <select name="cabinet_id" id="cabinet_id"
                                            class="form-select @error('cabinet_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Lemari Arsip</option>
                                            @foreach ($cabinets as $cabinet)
                                                @if (old('cabinet_id', $archive->cabinet_id) == $cabinet->id)
                                                    <option value="{{ $cabinet->id }}" selected>
                                                        {{ $cabinet->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $cabinet->id }}">{{ $cabinet->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('cabinet_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="shelf_id" class="form-label">Rak Arsip</label>
                                        <select name="shelf_id" id="shelf_id"
                                            class="form-select @error('shelf_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Rak Arsip</option>
                                            @foreach ($shelves as $shelf)
                                                @if (old('shelf_id', $archive->shelf_id) == $shelf->id)
                                                    <option value="{{ $shelf->id }}" selected>
                                                        {{ $shelf->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $shelf->id }}">{{ $shelf->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('shelf_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="shelf_row_id" class="form-label">Baris Rak Arsip</label>
                                        <select name="shelf_row_id" id="shelf_row_id"
                                            class="form-select @error('shelf_row_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Baris Rak Arsip</option>
                                            @foreach ($shelfRows as $shelfRow)
                                            @if (old('shelf_row_id', $archive->shelf_row_id) == $shelfRow->id)
                                                <option value="{{ $shelfRow->id }}" selected>
                                                    {{ $shelfRow->name }}
                                                </option>
                                            @else
                                                <option value="{{ $shelfRow->id }}">{{ $shelfRow->name }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                        @error('shelf_row_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="box_id" class="form-label">Box Arsip</label>
                                        <select name="box_id" id="box_id"
                                            class="form-select @error('box_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Box Arsip</option>
                                            @foreach ($boxes as $box)
                                                @if (old('box_id', $archive->box_id) == $box->id)
                                                    <option value="{{ $box->id }}" selected>
                                                        {{ $box->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $box->id }}">{{ $box->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('box_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="folder_id" class="form-label">Folder Arsip</label>
                                        <select name="folder_id" id="folder_id"
                                            class="form-select @error('folder_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Folder Arsip</option>
                                            @foreach ($folders as $folder)
                                                @if (old('folder_id', $archive->folder_id) == $folder->id)
                                                    <option value="{{ $folder->id }}" selected>
                                                        {{ $folder->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('folder_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                {{-- Button --}}
                                <div class="mt-5 mb-2 me-2 text-end">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
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
    {{-- <script>
        $(document).ready(function() {

            $('#anggaran_kegiatan').on('input', function() {
                $(this).val($(this).val().replace(/\D/g, ''));
                var amount = $(this).val().replace(/[^\d]/g, ''); // Remove non-numeric characters
                if (amount.length > 0) {
                    amount = parseInt(amount, 10); // Convert to integer
                    $(this).val(formatRupiah(amount)); // Format as Rupiah
                }
            });

            $('#target_keuangan').on('input', function() {
                $(this).val($(this).val().replace(/\D/g, ''));
                var amount = $(this).val().replace(/[^\d]/g, ''); // Remove non-numeric characters
                if (amount.length > 0) {
                    amount = parseInt(amount, 10); // Convert to integer
                    $(this).val(formatRupiah(amount)); // Format as Rupiah
                }
            });

            $('#realisasi_keuangan').on('input', function() {
                $(this).val($(this).val().replace(/\D/g, ''));
                var amount = $(this).val().replace(/[^\d]/g, ''); // Remove non-numeric characters
                if (amount.length > 0) {
                    amount = parseInt(amount, 10); // Convert to integer
                    $(this).val(formatRupiah(amount)); // Format as Rupiah
                }
            });

            $('#target_fisik').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9,]/g, ''));
                   
                // Allow only one decimal point
                var inputVal = $(this).val(); 
                var decimalCount = (inputVal.match(/\,/g) || []).length;

                if (decimalCount > 1) {
                    // More than one decimal point found, remove extra
                    var lastIndex = inputVal.lastIndexOf(',');
                    $(this).val(inputVal.substring(0, lastIndex));
                }
            });
            
            $('#realisasi_fisik').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9,]/g, ''));
                   
                // Allow only one decimal point
                var inputVal = $(this).val(); 
                var decimalCount = (inputVal.match(/\,/g) || []).length;

                if (decimalCount > 1) {
                    // More than one decimal point found, remove extra
                    var lastIndex = inputVal.lastIndexOf('.');
                    $(this).val(inputVal.substring(0, lastIndex));
                }
            });


            function formatRupiah(angka) {
                var number_string = angka.toString();
                var split = number_string.split(',');
                var sisa = split[0].length % 3;
                var rupiah = split[0].substr(0, sisa);
                var ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah;
            }


            // Handle Dones Field Row
            var i = 0;
            $("#donesAddBtn").click(function() {
                ++i;
                $("#donesRow").append(
                    `<div class="row align-items-end my-2" id="donesField">
                        <div class="col-10 col-md-11">
                            <input type="text" class="form-control" id="dones" name="dones[` + i + `]" value="{{ old('dones.`+ i +`') ?: '' }}">
                        </div>
                        <div class="col-2 col-md-1">
                            <btn type="button" class="btn btn btn-outline-danger" id="donesRemoveBtn">
                                <i class="bi bi-dash-circle"></i>
                            </btn>
                        </div>
                     </div>`
                );
            });
            $(document).on('click', '#donesRemoveBtn', function() {
                $(this).parents('#donesField').remove();
            });

            // Handle Problems Field Row
            var j = 0;
            $("#problemsAddBtn").click(function() {
                ++j;
                $("#problemsRow").append(
                    `<div class="row align-items-end my-2" id="problemsField">
                        <div class="col-10 col-md-11">
                            <input type="text" class="form-control" id="problems" name="problems[` + j + `]" value="{{ old('problems.`+ j +`') ?: '' }}">
                        </div>
                        <div class="col-2 col-md-1">
                            <btn type="button" class="btn btn btn-outline-danger" id="problemsRemoveBtn">
                                <i class="bi bi-dash-circle"></i>
                            </btn>
                        </div>
                     </div>`
                );
            });
            $(document).on('click', '#problemsRemoveBtn', function() {
                $(this).parents('#problemsField').remove();
            });

            // Handle FollowUp Field Row
            var k = 0;
            $("#followUpAddBtn").click(function() {
                ++k;
                $("#followUpRow").append(
                    `<div class="row align-items-end my-2" id="followUpField">
                        <div class="col-10 col-md-11">
                            <input type="text" class="form-control" id="follow_up" name="follow_up[` + k + `]" value="{{ old('follow_up.`+ k +`') ?: '' }}">
                        </div>
                        <div class="col-2 col-md-1">
                            <btn type="button" class="btn btn btn-outline-danger" id="followUpRemoveBtn">
                                <i class="bi bi-dash-circle"></i>
                            </btn>
                        </div>
                     </div>`
                );
            });
            $(document).on('click', '#followUpRemoveBtn', function() {
                $(this).parents('#followUpField').remove();
            });

            // Handle Todos Field Row
            var l = 0;
            $("#todosAddBtn").click(function() {
                ++l;
                $("#todosRow").append(
                    `<div class="row align-items-end my-2" id="todosField">
                        <div class="col-10 col-md-11">
                            <input type="text" class="form-control" id="todos" name="todos[` + l + `]" value="{{ old('todos.`+ l +`') ?: '' }}">
                        </div>
                        <div class="col-2 col-md-1">
                            <btn type="button" class="btn btn btn-outline-danger" id="todosRemoveBtn">
                                <i class="bi bi-dash-circle"></i>
                            </btn>
                        </div>
                     </div>`
                );
            });
            $(document).on('click', '#todosRemoveBtn', function() {
                $(this).parents('#todosField').remove();
            });
        });
    </script> --}}
@endpush
