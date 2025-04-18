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
                // 'user',
                'work_unit',
                // 'work_group',
                // 'work_team',
                'work_team_classification',
                // 'archive_retention',
                // 'archive_type',
                'archive_development_level',
                'archive_media',
                'archive_condition',
                'archive_quantity_unit',
                // 'archive_final_depreciation_action',
                // 'archive_security_classification',
                // 'archive_access_level',
                // 'archive_public_access_level',
                // 'archive_status',
                'building',
                // 'cabinet',
                // 'shelf',
                // 'shelfRow',
                // 'box',
                // 'folder'
            ])->get();         

            return DataTables::of($archives)
                ->addIndexColumn()
                ->addColumn('work_unit', fn($archive) => $archive->work_unit->name ?? '-')
                // ->addColumn('work_group', fn($archive) => $archive->work_group->name ?? '-')
                // ->addColumn('work_team', fn($archive) => $archive->work_team->name ?? '-')
                ->addColumn('work_team_classification', fn($archive) => $archive->work_team_classification->name ?? '-')
                ->addColumn('archive_description', fn($archive) => $archive->archive_description ?? '-')
                ->addColumn('archive_lifespan', fn($archive) => $archive->archive_lifespan ?? '-')
                ->addColumn('archive_development_level', fn($archive) => $archive->archive_development_level->name ?? '-')
                ->addColumn('archive_media', fn($archive) => $archive->archive_media->name ?? '-')
                ->addColumn('archive_condition', fn($archive) => $archive->archive_condition->name ?? '-')
                ->addColumn('archive_number', fn($archive) => $archive->archive_number . ' ' . $archive->archive_quantity_unit->name ?? '-')
                ->addColumn('building', fn($archive) => $archive->building->name ?? '-')
                ->addColumn('cabinet', fn($archive) => $archive->cabinet->name ?? '-')
                ->addColumn('shelf', fn($archive) => $archive->shelf->name ?? '-')
                ->addColumn('shelf_row', fn($archive) => $archive->shelf_row->name ?? '-')
                ->addColumn('box', fn($archive) => $archive->box->name ?? '-')
                ->addColumn('folder', fn($archive) => $archive->folder->name ?? '-')
                // ->addColumn('archive_retention', fn($archive) => $archive->archive_retention->name ?? '-')
                // ->addColumn('archive_type', fn($archive) => $archive->archive_type->name ?? '-')
                // ->addColumn('archive_final_depreciation_action', fn($archive) => $archive->archive_final_depreciation_action->name ?? '-')
                // ->addColumn('archive_security_classification', fn($archive) => $archive->archive_security_classification->name ?? '-')
                // ->addColumn('archive_access_level', fn($archive) => $archive->archive_access_level->name ?? '-')
                // ->addColumn('archive_public_access_level', fn($archive) => $archive->archive_public_access_level->name ?? '-')
                // ->addColumn('archive_status', fn($archive) => $archive->archive_status->name ?? '-')
                // ->addColumn('user', fn($archive) => $archive->user->name ?? '-')
                ->addColumn('action', function ($archive) {
                    return view('components.admin.button', compact('archive'))->render();
                })
                ->rawColumns(['action']) // agar HTML tombol tidak di-escape
                ->make(true);
        }
        return view('apps.archive.index');
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
}
