<?php

namespace App\Http\Controllers;

use App\DataTables\ArchiveDataTable;
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
use App\Models\ArchiveType;
use App\Models\Box;
use App\Models\Building;
use App\Models\Cabinet;
use App\Models\Folder;
use App\Models\Shelf;
use App\Models\ShelfRow;
use App\Models\WorkGroup;
use App\Models\WorkTeam;
use App\Models\WorkTeamClassification;
use App\Models\WorkUnit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $archives = Archive::with([
                'work_team_classification:id,name',
                'archive_status:id,name'
            ])->select([
                'id',
                'work_team_classification_id',
                'archive_status_id',
                'archive_description',
                'archive_lifespan',
            ]);


           if ($request->work_team_classification) {
                $archives->whereHas('work_team_classification', function ($q) use ($request) {
                    $q->where('name', $request->work_team_classification);
                });
            }

           if ($request->archive_status) {
                $archives->whereHas('archive_status', function ($q) use ($request) {
                    $q->where('name', $request->archive_status);
                });
            }

            if ($request->archive_lifespan) {
                $archives->where('archive_lifespan', $request->archive_lifespan)
                         ->orderByRaw('CAST(archive_lifespan AS UNSIGNED) DESC');
            } else {
                // Default urut berdasarkan id terbaru
                $archives->orderByDesc('id');
            }

            return DataTables::eloquent($archives)
                ->addIndexColumn()
                ->addColumn('work_team_classification', fn($archive) => $archive->work_team_classification->name ?? '-')
                ->addColumn('archive_description', fn($archive) => $archive->archive_description ?? '-')
                ->addColumn('archive_lifespan', fn($archive) => $archive->archive_lifespan ?? '-')
                ->addColumn('archive_status', fn($archive) => $archive->archive_status->name ?? '-')
                ->addColumn('action', function ($archive) {
                    return view('components.admin.button', compact('archive'))->render();
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->search['value'] != '') {
                        $search = $request->search['value'];

                        $query->where('archive_description', 'like', "%{$search}%");
    
                        // $query->where(function ($q) use ($search) {
                        //     $q->where('archive_description', 'like', "%{$search}%")
                        //       ->orWhere('archive_lifespan', 'like', "%{$search}%")
                        //       ->orWhereHas('work_team_classification', function ($subQuery) use ($search) {
                        //           $subQuery->where('name', 'like', "%{$search}%");
                        //       })
                        //       ->orWhereHas('archive_status', function ($subQuery) use ($search) {
                        //           $subQuery->where('name', 'like', "%{$search}%");
                        //       });
                        // });
                    }

                    
                })
                ->rawColumns(['action']) // agar HTML tombol tidak di-escape
                ->make(true);
        }
        
        
        $workTeamClassificationList = WorkTeamClassification::select('name')->distinct()->get();
       
        $archiveStatusList = ArchiveStatus::select('name')->distinct()->get();

        $lifespanList = Archive::select('archive_lifespan')
                        ->whereNotNull('archive_lifespan')
                        ->distinct()
                        ->orderByRaw('CAST(archive_lifespan AS UNSIGNED) DESC')
                        ->pluck('archive_lifespan');

        return view('apps.archive.index', compact([
            'workTeamClassificationList',
            'archiveStatusList',
            'lifespanList'
        ]));
    }

    public function create(){
        
        // Initiate Data
        $workUnits = WorkUnit::get(['id', 'name']);
        $workGroups = WorkGroup::get(['id', 'name']);
        $workTeams = WorkTeam::get(['id', 'name']);
        $workTeamClassifications = WorkTeamClassification::get(['id', 'name']);
        $archiveRetentions = ArchiveRetention::get(['id', 'range']);
        $archiveTypes = ArchiveType::get(['id', 'name']);
        $archiveStatuses = ArchiveStatus::get(['id', 'name']);
        $archiveDevelopmentLevels = ArchiveDevelopmentLevel::get(['id', 'name']);
        $archiveMedias = ArchiveMedia::get(['id', 'name']);
        $archiveConditions = ArchiveCondition::get(['id', 'name']);
        $archiveQuantityUnits = ArchiveQuantityUnit::get(['id', 'name']);
        $archiveFinalDepreciationActions = ArchiveFinalDepreciationAction::get(['id', 'name']);
        $archiveSecurityClassifications = ArchiveSecurityClassification::get(['id', 'name']);
        $archivePublicAccessLevels = ArchivePublicAccessLevel::get(['id', 'name']);
        $archiveAccessLevels = ArchiveAccessLevel::get(['id', 'name']);
        $buildings = Building::get(['id', 'name']);
        $cabinets = Cabinet::get(['id', 'name']);
        $shelves = Shelf::get(['id', 'name']);
        $shelfRows = ShelfRow::get(['id', 'name']);
        $boxes = Box::get(['id', 'name']);
        $folders = Folder::get(['id', 'name']);


        return view('apps.archive.create', compact([
            'workUnits',
            'workGroups',
            'workTeams',
            'workTeamClassifications',
            "archiveRetentions",
            "archiveTypes",
            "archiveStatuses",
            "archiveDevelopmentLevels",
            "archiveMedias",
            "archiveConditions",
            "archiveQuantityUnits",
            "archiveFinalDepreciationActions",
            "archiveSecurityClassifications",
            "archivePublicAccessLevels",
            "archiveAccessLevels",
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
            'user_id' => 'required',
            'work_unit_id' => 'required',
            'work_group_id' => 'required',
            'work_team_id' => 'required',
            'work_team_classification_id' => 'required',
            'archive_retention_id' => 'required',
            'archive_type_id' => 'required',
            'archive_development_level_id' => 'required',
            'archive_media_id' => 'required',
            'archive_condition_id' => 'required',
            'archive_final_depreciation_action_id' => 'required',
            'archive_security_classification_id' => 'required',
            'archive_access_level_id' => 'required',
            'archive_public_access_level_id' => 'required',
            'archive_status_id' => 'required',
            'archive_quantity_unit_id' => 'required',
            'archive_letter_origin_number' => 'required',
            'archive_description' => 'required',
            'archive_lifespan' => 'required',
            'archive_number' => 'required',
            'archive_input_date' => 'required',
            'building_id' => 'required',
            'cabinet_id' => 'required',
            'shelf_id' => 'required',
            'shelf_row_id' => 'required',
            'box_id' => 'required',
            'folder_id' => 'required',

        ],[
            'user_id.required' => 'User ID field is required!',
            'work_unit_id.required' => 'Unit Kerja field is required!',
            'work_group_id.required' => 'Kelompok Kerja field is required!',
            'work_team_id.required' => 'Tim Kerja field is required!',
            'work_team_classification_id.required' => 'Klasifikasi field is required!',
            'archive_retention_id.required' => 'Retensi Arsip field is required!',
            'archive_type_id.required' => 'Tipe Arsip field is required!',
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
            'archive_number.required' => 'Jumlah Arsip field is required!',
            'archive_input_date.required' => 'Tanggal Input Arsip field is required!',
            'building_id.required' => 'Gedung Arsip field is required!',
            'cabinet_id.required' => 'Lemari Arsip field is required!',
            'shelf_id.required' => 'Rak Arsip field is required!',
            'shelf_row_id.required' => 'Baris Rak Arsip field is required!',
            'box_id.required' => 'Boks Arsip field is required!',
            'folder_id.required' => 'Folder Arsip field is required!',
        ]);

        Archive::create($validated);

        return redirect()->route('archive-index')->with('success', 'Data Arsip Baru Berhasil Ditambahkan');
    }

    public function edit(Archive $archive){
        
        // Initiate Data
        $workUnits = WorkUnit::get(['id', 'name']);
        $workGroups = WorkGroup::get(['id', 'name']);
        $workTeams = WorkTeam::get(['id', 'name']);
        $workTeamClassifications = WorkTeamClassification::get(['id', 'name']);
        $archiveRetentions = ArchiveRetention::get(['id', 'range']);
        $archiveTypes = ArchiveType::get(['id', 'name']);
        $archiveStatuses = ArchiveStatus::get(['id', 'name']);
        $archiveDevelopmentLevels = ArchiveDevelopmentLevel::get(['id', 'name']);
        $archiveMedias = ArchiveMedia::get(['id', 'name']);
        $archiveConditions = ArchiveCondition::get(['id', 'name']);
        $archiveQuantityUnits = ArchiveQuantityUnit::get(['id', 'name']);
        $archiveFinalDepreciationActions = ArchiveFinalDepreciationAction::get(['id', 'name']);
        $archiveSecurityClassifications = ArchiveSecurityClassification::get(['id', 'name']);
        $archivePublicAccessLevels = ArchivePublicAccessLevel::get(['id', 'name']);
        $archiveAccessLevels = ArchiveAccessLevel::get(['id', 'name']);
        $buildings = Building::get(['id', 'name']);
        $cabinets = Cabinet::get(['id', 'name']);
        $shelves = Shelf::get(['id', 'name']);
        $shelfRows = ShelfRow::get(['id', 'name']);
        $boxes = Box::get(['id', 'name']);
        $folders = Folder::get(['id', 'name']);


        return view('apps.archive.edit', compact([
            'archive',
            'workUnits',
            'workGroups',
            'workTeams',
            'workTeamClassifications',
            "archiveRetentions",
            "archiveTypes",
            "archiveStatuses",
            "archiveDevelopmentLevels",
            "archiveMedias",
            "archiveConditions",
            "archiveQuantityUnits",
            "archiveFinalDepreciationActions",
            "archiveSecurityClassifications",
            "archivePublicAccessLevels",
            "archiveAccessLevels",
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
            'user_id' => 'required',
            'work_unit_id' => 'required',
            'work_group_id' => 'required',
            'work_team_id' => 'required',
            'work_team_classification_id' => 'required',
            'archive_retention_id' => 'required',
            'archive_type_id' => 'required',
            'archive_development_level_id' => 'required',
            'archive_media_id' => 'required',
            'archive_condition_id' => 'required',
            'archive_final_depreciation_action_id' => 'required',
            'archive_security_classification_id' => 'required',
            'archive_access_level_id' => 'required',
            'archive_public_access_level_id' => 'required',
            'archive_status_id' => 'required',
            'archive_quantity_unit_id' => 'required',
            'archive_letter_origin_number' => 'required',
            'archive_description' => 'required',
            'archive_lifespan' => 'required',
            'archive_number' => 'required',
            'archive_input_date' => 'required',
            'building_id' => 'required',
            'cabinet_id' => 'required',
            'shelf_id' => 'required',
            'shelf_row_id' => 'required',
            'box_id' => 'required',
            'folder_id' => 'required',

        ],[
            'user_id.required' => 'User ID field is required!',
            'work_unit_id.required' => 'Unit Kerja field is required!',
            'work_group_id.required' => 'Kelompok Kerja field is required!',
            'work_team_id.required' => 'Tim Kerja field is required!',
            'work_team_classification_id.required' => 'Klasifikasi field is required!',
            'archive_retention_id.required' => 'Retensi Arsip field is required!',
            'archive_type_id.required' => 'Tipe Arsip field is required!',
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
            'archive_number.required' => 'Jumlah Arsip field is required!',
            'archive_input_date.required' => 'Tanggal Input Arsip field is required!',
            'building_id.required' => 'Gedung Arsip field is required!',
            'cabinet_id.required' => 'Lemari Arsip field is required!',
            'shelf_id.required' => 'Rak Arsip field is required!',
            'shelf_row_id.required' => 'Baris Rak Arsip field is required!',
            'box_id.required' => 'Boks Arsip field is required!',
            'folder_id.required' => 'Folder Arsip field is required!',
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
