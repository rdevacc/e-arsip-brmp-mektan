<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ArchiveAccessLevel;
use App\Models\ArchiveCondition;
use App\Models\ArchiveDevelopmentLevel;
use App\Models\ArchiveFinalDepreciationAction;
use App\Models\ArchiveMedia;
use App\Models\ArchivePublicAccessLevel;
use App\Models\ArchiveQuantityUnit;
use App\Models\ArchiveRetention;
use App\Models\ArchiveSecurityClassification;
use App\Models\ArchiveStatus;
use App\Models\ArchiveBuilding;
use App\Models\ArchiveCabinet;
use App\Models\ArchiveShelf;
use App\Models\ArchiveShelfRow;
use App\Models\ArchiveBox;
use App\Models\ArchiveFolder;
use App\Models\Period;
use App\Models\WorkGroup;
use App\Models\WorkTeam;
use App\Models\WorkTeamClassification;
use App\Models\WorkUnit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ArchiveController extends Controller
{
    public function getWorkTeams($work_group_id)
    {
        $teams = WorkTeam::where('work_group_id', $work_group_id)->get(['id', 'name']);
        return response()->json($teams);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:archive_statuses,id',
        ]);

        $musnahId = 8;

        $archive = Archive::findOrFail($id);
        $archive->archive_status_id = $request->status_id;

        if ($request->status_id == $musnahId) {
            // Reset lokasi arsip jadi null karena status musnah
            $archive->building_id = null;
            $archive->cabinet_id = null;
            $archive->shelf_id = null;
            $archive->shelf_row_id = null;
            $archive->archive_box_id = null;
            $archive->archive_folder_id = null;
        }

        $archive->save();

        return response()->json(['message' => 'Status berhasil diperbarui']);
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'status_id' => 'nullable|integer|exists:archive_statuses,id',
            'period_id' => 'nullable|integer|exists:periods,id',
            'year_period' => 'nullable|string|max:255',
        ]);

        $updateData = [];

        if ($request->filled('status_id')) {
            $updateData['archive_status_id'] = $request->status_id;
        }

        if ($request->filled('period_id')) {
            $updateData['period_id'] = $request->period_id;
        }

        if ($request->filled('year_period')) {
            $updateData['year_period'] = $request->year_period;
        }

        if (empty($updateData)) {
            return response()->json(['message' => 'Tidak ada perubahan yang dikirim.'], 422);
        }

        $updateData['updated_at'] = now();

        Archive::whereIn('id', $request->ids)->update($updateData);

        return response()->json(['message' => 'Data arsip berhasil diperbarui.']);
    }

    public function index(Request $request)
    {
        // Getting Statuses
        $statuses = ArchiveStatus::orderBy('name')->get(['id', 'name']);
        
        if ($request->ajax()) {
            $archives = Archive::select(
                'archives.*',
                'wtc.code as work_team_classification_code',
                'ast.name as archive_status_name',
                'prd.name as period_name',
                'archives.year_period as year_period_name'
            )
            ->leftJoin('work_team_classifications as wtc', 'archives.work_team_classification_id', '=', 'wtc.id')
            ->leftJoin('periods as prd', 'archives.period_id', '=', 'prd.id')
            ->leftJoin('archive_statuses as ast', 'archives.archive_status_id', '=', 'ast.id');

            // Filter
            if ($request->work_team_classification) {
                $archives->where('wtc.code', $request->work_team_classification);
            }

            if ($request->archive_status) {
                $archives->where('ast.name', $request->archive_status);
            }

            if ($request->period) {
                $archives->where('prd.name', $request->period);
            }

            if ($request->year_period) {
                $archives->where('archives.year_period', 'like', '%' . $request->year_period . '%');
            }

            if ($request->archive_lifespan) {
                $archives->where('archives.archive_lifespan', $request->archive_lifespan);
            }

            // Tangani sorting manual berdasarkan kolom yang diklik
            if ($request->order) {
                $columnIndex = $request->order[0]['column'];
                $dir = $request->order[0]['dir'];

                // Mapping index kolom datatable ke kolom database
                // Sesuaikan index dengan urutan kolom di frontend (columns array)
                $columns = [
                    1 => 'wtc.code',
                    3 => 'archives.archive_lifespan',
                    4 => 'prd.name',
                    5 => 'archives.year_period',
                    6 => 'ast.name',
                ];

                if (isset($columns[$columnIndex])) {
                    $archives->orderBy($columns[$columnIndex], $dir);
                } else {
                    $archives->orderByDesc('archives.id');
                }
            } else {
                // Default order
                $archives->orderBy('work_team_classification_code', 'asc')
                        ->orderByDesc('archive_lifespan');
            }

            
            return DataTables::eloquent($archives)
                ->addIndexColumn()
                ->addColumn('work_team_classification', fn($archive) => $archive->work_team_classification_code ?? '-')
                ->addColumn('archive_description', fn($archive) => $archive->archive_description ?? '-')
                ->addColumn('archive_lifespan', fn($archive) => $archive->archive_lifespan ?? '-')
                ->addColumn('period_name', fn($archive) => $archive->period_name ?? '-')
                ->addColumn('year_period', fn($archive) => $archive->year_period ?? '-')
                ->addColumn('archive_status', fn($archive) => $archive->archive_status_name ?? '-')
                ->addColumn('action', function ($archive) use ($statuses) {
                    return view('components.admin.button', compact('archive', 'statuses'))->render();
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->search['value'] != '') {
                        $search = $request->search['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('archive_description', 'like', "%{$search}%");
                        });
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Data for filters (optional)
        $workTeamClassificationList = Archive::with('work_team_classification')
                                    ->whereNotNull('work_team_classification_id')
                                    ->get()
                                    ->pluck('work_team_classification')
                                    ->unique('id')
                                    ->sortByDesc('id')
                                    ->values();

        $archiveStatusList = Archive::with('archive_status')
                                    ->whereNotNull('archive_status_id')
                                    ->get()
                                    ->pluck('archive_status')
                                    ->unique('id')
                                    ->sortByDesc('id')
                                    ->values();

        $lifespanList = Archive::select('archive_lifespan')
                        ->whereNotNull('archive_lifespan')
                        ->distinct()
                        ->orderByRaw('CAST(archive_lifespan AS UNSIGNED) DESC')
                        ->pluck('archive_lifespan');

        $periodList = Period::get(['id', 'name']);

        $yearPeriodList = Archive::select('year_period')
                        ->whereNotNull('year_period')
                        ->distinct()
                        ->orderByRaw('CAST(year_period AS UNSIGNED) DESC')
                        ->pluck('year_period');

        return view('apps.archive.index', compact([
            'workTeamClassificationList',
            'archiveStatusList',
            'lifespanList',
            'periodList',
            'yearPeriodList',
            'statuses'
        ]));
    }


    public function create(){
        
        // Initiate Data
        $workUnits = WorkUnit::get(['id', 'name']);
        $workGroups = WorkGroup::get(['id', 'name']);
        $workTeamClassifications = WorkTeamClassification::get(['id', 'name', 'code']);
        $archiveRetentions = ArchiveRetention::get(['id', 'range_value']);
        $archiveStatuses = ArchiveStatus::orderBy('name')->get(['id', 'name']);
        $archiveDevelopmentLevels = ArchiveDevelopmentLevel::get(['id', 'name']);
        $archiveMedias = ArchiveMedia::get(['id', 'name']);
        $archiveConditions = ArchiveCondition::get(['id', 'name']);
        $archiveQuantityUnits = ArchiveQuantityUnit::get(['id', 'name']);
        $archiveFinalDepreciationActions = ArchiveFinalDepreciationAction::get(['id', 'name']);
        $archiveSecurityClassifications = ArchiveSecurityClassification::get(['id', 'name']);
        $archivePublicAccessLevels = ArchivePublicAccessLevel::get(['id', 'name']);
        $archiveAccessLevels = ArchiveAccessLevel::get(['id', 'name']);
        $periods = Period::get(['id', 'name']);
        $buildings = ArchiveBuilding::get(['id', 'name']);
        $cabinets = ArchiveCabinet::get(['id', 'name']);
        $shelves = ArchiveShelf::get(['id', 'name']);
        $shelfRows = ArchiveShelfRow::get(['id', 'name']);
        $boxes = ArchiveBox::get(['id', 'name']);
        $folders = ArchiveFolder::get(['id', 'name']);

        if (old('work_team_classification_id')) {
            $selected = WorkTeamClassification::find(old('work_team_classification_id'));
            if ($selected) {
                session()->flash('old_work_team_classification_text', $selected->code . ' - ' . $selected->name);
            }
        }

        return view('apps.archive.create', compact([
            'workUnits',
            'workGroups',
            'workTeamClassifications',
            "archiveRetentions",
            "archiveStatuses",
            "archiveDevelopmentLevels",
            "archiveMedias",
            "archiveConditions",
            "archiveQuantityUnits",
            "archiveFinalDepreciationActions",
            "archiveSecurityClassifications",
            "archivePublicAccessLevels",
            "archiveAccessLevels",
            "periods",
            "buildings",
            "cabinets",
            "shelves",
            "shelfRows",
            "boxes",
            "folders",
        ]));
    }

    public function store(Request $request){
        // Validate Data
        $validated = $request->validate([
            'user_id' => '',
            'work_unit_id' => '',
            'work_group_id' => '|exists:work_groups,id',
            'work_team_id' => [
                '',
                Rule::exists('work_teams', 'id')->where('work_group_id', $request->work_group_id)
            ],
            'work_team_classification_id' => '',
            'archive_retention_id' => '',
            'archive_development_level_id' => '',
            'archive_media_id' => '',
            'archive_condition_id' => '',
            'archive_final_depreciation_action_id' => '',
            'archive_security_classification_id' => '',
            'archive_access_level_id' => '',
            'archive_public_access_level_id' => '',
            'archive_status_id' => '',
            'archive_quantity_unit_id' => '',
            'archive_letter_origin_number' => '',
            'archive_description' => '',
            'archive_lifespan' => '',
            'archive_number' => '',
            'archive_input_date' => '',
            'period_id' => '',
            'year_period' => '',
            'archive_building_id' => '',
            'archive_cabinet_id' => '',
            'archive_shelf_id' => '',
            'archive_shelf_row_id' => '',
            'archive_box_id' => '',
            'archive_folder_id' => '',
        ],[
            'user_id.required' => 'User ID field is required!',
            'work_unit_id.required' => 'Unit Kerja field is required!',
            'work_group_id.required' => 'Kelompok Kerja field is required!',
            'work_team_id.required' => 'Tim Kerja field is required!',
            'work_team_classification_id.required' => 'Klasifikasi field is required!',
            'archive_retention_id.required' => 'Retensi Arsip field is required!',
            'archive_development_level_id.required' => 'Tingkat Perkembangan Arsip field is required!',
            'archive_media_id.required' => 'Media Arsip field is required!',
            'archive_condition_id.required' => 'Kondisi Arsip field is required!',
            'archive_final_depreciation_action_id.required' => 'Tindakan Penyusutan Akhir Arsip  field is required!',
            'archive_security_classification_id.required' => 'Klasifikasi Keamanan Arsip field is required!',
            'archive_public_access_level_id.required' => 'Tingkat Akses Publik Arsip field is required!',
            'archive_access_level_id.required' => 'Level Akses Arsip field is required!',
            'archive_status_id.required' => 'Status Arsip field is required!',
            'archive_quantity_unit_id.required' => 'Unit Kuantitas Arsip field is required!',
            'archive_letter_origin_number.required' => 'Nomor Asal Surat Arsip field is required!',
            'archive_description.required' => 'Uraian Arsip field is required!',
            'archive_lifespan.required' => 'Kurun Waktu Arsip field is required!',
            'archive_lifespan.integer' => 'Kurun Waktu Arsip field must be an integer!',
            'archive_lifespan.digits' => 'Kurun Waktu Arsip field must 4 digits!',
            'archive_lifespan.min' => 'Kurun Waktu Arsip field min 1900!',
            'archive_lifespan.max' => 'Kurun Waktu Arsip field max 2100!',
            'archive_number.required' => 'Jumlah Arsip field is required!',
            'archive_input_date.required' => 'Tanggal Input Arsip field is required!',
            'period.required' => 'Periode Arsip field is required!',
            'year_period.required' => 'Tahun Periode Arsip field is required!',
            'archive_building_id.required' => 'Gedung Arsip field is required!',
            'archive_cabinet_id.required' => 'Lemari Arsip field is required!',
            'archive_shelf_id.required' => 'Rak Arsip field is required!',
            'archive_shelf_row_id.required' => 'Baris Rak Arsip field is required!',
            'archive_box_id.required' => 'Boks Arsip field is required!',
            'archive_folder_id.required' => 'Folder Arsip field is required!',
        ]);

        Archive::create($validated);

        return redirect()->route('archive-index')->with('success', 'Data Arsip Baru Berhasil Ditambahkan');
    }

    public function edit(Archive $archive){
        
        // Initiate Data
        $workUnits = WorkUnit::get(['id', 'name']);
        $workGroups = WorkGroup::get(['id', 'name']);
        $workTeams = WorkTeam::get(['id', 'name']);
        $workTeamClassifications = WorkTeamClassification::get(['id', 'name', 'code']);
        $archiveRetentions = ArchiveRetention::get(['id', 'range_value']);
        $archiveStatuses = ArchiveStatus::orderBy('name')->get(['id', 'name']);
        $archiveDevelopmentLevels = ArchiveDevelopmentLevel::get(['id', 'name']);
        $archiveMedias = ArchiveMedia::get(['id', 'name']);
        $archiveConditions = ArchiveCondition::get(['id', 'name']);
        $archiveQuantityUnits = ArchiveQuantityUnit::get(['id', 'name']);
        $archiveFinalDepreciationActions = ArchiveFinalDepreciationAction::get(['id', 'name']);
        $archiveSecurityClassifications = ArchiveSecurityClassification::get(['id', 'name']);
        $archivePublicAccessLevels = ArchivePublicAccessLevel::get(['id', 'name']);
        $archiveAccessLevels = ArchiveAccessLevel::get(['id', 'name']);
        $periods = Period::get(['id', 'name']);
        $buildings = ArchiveBuilding::get(['id', 'name']);
        $cabinets = ArchiveCabinet::get(['id', 'name']);
        $shelves = ArchiveShelf::get(['id', 'name']);
        $shelfRows = ArchiveShelfRow::get(['id', 'name']);
        $boxes = ArchiveBox::get(['id', 'name']);
        $folders = ArchiveFolder::get(['id', 'name']);


        return view('apps.archive.edit', compact([
            'archive',
            'workUnits',
            'workGroups',
            'workTeams',
            'workTeamClassifications',
            "archiveRetentions",
            "archiveStatuses",
            "archiveDevelopmentLevels",
            "archiveMedias",
            "archiveConditions",
            "archiveQuantityUnits",
            "archiveFinalDepreciationActions",
            "archiveSecurityClassifications",
            "archivePublicAccessLevels",
            "archiveAccessLevels",
            "periods",
            "buildings",
            "cabinets",
            "shelves",
            "shelfRows",
            "boxes",
            "folders",
        ]));
    }

    public function update(Request $request, Archive $archive){
         // Validate Data
         $validated = $request->validate([
            'user_id' => '',
            'work_unit_id' => '',
            'work_group_id' => '|exists:work_groups,id',
            'work_team_id' => [
                '',
                Rule::exists('work_teams', 'id')->where('work_group_id', $request->work_group_id)
            ],
            'work_team_classification_id' => '',
            'archive_retention_id' => '',
            'archive_development_level_id' => '',
            'archive_media_id' => '',
            'archive_condition_id' => '',
            'archive_final_depreciation_action_id' => '',
            'archive_security_classification_id' => '',
            'archive_access_level_id' => '',
            'archive_public_access_level_id' => '',
            'archive_status_id' => '',
            'archive_quantity_unit_id' => '',
            'archive_letter_origin_number' => '',
            'archive_description' => '',
            'archive_lifespan' => '',
            'archive_number' => '',
            'archive_input_date' => '',
            'period_id' => '',
            'year_period' => '',
            'archive_building_id' => '',
            'archive_cabinet_id' => '',
            'archive_shelf_id' => '',
            'archive_shelf_row_id' => '',
            'archive_box_id' => '',
            'archive_folder_id' => '',
        ],[
            'user_id.required' => 'User ID field is required!',
            'work_unit_id.required' => 'Unit Kerja field is required!',
            'work_group_id.required' => 'Kelompok Kerja field is required!',
            'work_team_id.required' => 'Tim Kerja field is required!',
            'work_team_classification_id.required' => 'Klasifikasi field is required!',
            'archive_retention_id.required' => 'Retensi Arsip field is required!',
            'archive_development_level_id.required' => 'Tingkat Perkembangan Arsip field is required!',
            'archive_media_id.required' => 'Media Arsip field is required!',
            'archive_condition_id.required' => 'Kondisi Arsip field is required!',
            'archive_final_depreciation_action_id.required' => 'Tindakan Penyusutan Akhir Arsip  field is required!',
            'archive_security_classification_id.required' => 'Klasifikasi Keamanan Arsip field is required!',
            'archive_public_access_level_id.required' => 'Tingkat Akses Publik Arsip field is required!',
            'archive_access_level_id.required' => 'Level Akses Arsip field is required!',
            'archive_status_id.required' => 'Status Arsip field is required!',
            'archive_quantity_unit_id.required' => 'Unit Kuantitas Arsip field is required!',
            'archive_letter_origin_number.required' => 'Nomor Asal Surat Arsip field is required!',
            'archive_description.required' => 'Uraian Arsip field is required!',
            'archive_lifespan.required' => 'Kurun Waktu Arsip field is required!',
            'archive_lifespan.integer' => 'Kurun Waktu Arsip field must be an integer!',
            'archive_lifespan.digits' => 'Kurun Waktu Arsip field must 4 digits!',
            'archive_lifespan.min' => 'Kurun Waktu Arsip field min 1900!',
            'archive_lifespan.max' => 'Kurun Waktu Arsip field max 2100!',
            'archive_number.required' => 'Jumlah Arsip field is required!',
            'archive_input_date.required' => 'Tanggal Input Arsip field is required!',
            'period.required' => 'Periode Arsip field is required!',
            'year_period.required' => 'Tahun Periode Arsip field is required!',
            'archive_building_id.required' => 'Gedung Arsip field is required!',
            'archive_cabinet_id.required' => 'Lemari Arsip field is required!',
            'archive_shelf_id.required' => 'Rak Arsip field is required!',
            'archive_shelf_row_id.required' => 'Baris Rak Arsip field is required!',
            'archive_box_id.required' => 'Boks Arsip field is required!',
            'archive_folder_id.required' => 'Folder Arsip field is required!',
        ]);

        Archive::where('id', $archive->id)->update($validated);

        return redirect()->route('archive-index')->with('success', 'Data Arsip Berhasil Diupdate');
    }

    public function destroy(Archive $archive){
        // Destroy data by id
        Archive::destroy($archive->id);

        return redirect()->route('archive-index')->with('success', 'Data Arsip Berhasil Dihapus');
    }
}
