<?php

use App\Http\Controllers\ArchiveAccessLevelController;
use App\Http\Controllers\ArchiveBoxController;
use App\Http\Controllers\ArchiveConditionController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ArchiveDevelopmentLevelController;
use App\Http\Controllers\ArchiveFinalDepreciationActionController;
use App\Http\Controllers\ArchiveMediaController;
use App\Http\Controllers\ArchivePublicAccessLevelController;
use App\Http\Controllers\ArchiveQuantityUnitController;
use App\Http\Controllers\ArchiveRetentionController;
use App\Http\Controllers\ArchiveSecurityClassificationController;
use App\Http\Controllers\ArchiveStatusController;
use App\Http\Controllers\ArchiveBuildingController;
use App\Http\Controllers\ArchiveCabinetController;
use App\Http\Controllers\ArchiveFolderController;
use App\Http\Controllers\ArchiveReportController;
use App\Http\Controllers\ArchiveShelfController;
use App\Http\Controllers\ArchiveShelfRowController;
use App\Http\Controllers\ArchiveStorageLocationController;
use App\Http\Controllers\ArchiveSubTypeController;
use App\Http\Controllers\ArchiveTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportArchiveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkGroupController;
use App\Http\Controllers\WorkTeamClassificationController;
use App\Http\Controllers\WorkTeamController;
use App\Http\Controllers\WorkUnitController;
use App\Models\ArchiveStorageLocation;
use App\Models\ArchiveSubType;
use App\Models\WorkTeamClassification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/app')->group(function (){
    /**
     * * Archive Routes *
     */
    Route::resource('/archive', ArchiveController::class)->names([
        'index' => 'archive-index',
        'create' => 'archive-create',
        'show' => 'archive-show',
        'store' => 'archive-create-submit',
        'edit' => 'archive-edit',
        'update' => 'archive-edit-submit',
        'destroy' => 'archive-delete',
    ]);

    Route::get('/archive/work-teams/{work_group_id}', [ArchiveController::class, 'getWorkTeams'])->name('archive-get-work-teams');
    Route::get('/archive/team-classifications/{work_team_id}', [ArchiveController::class, 'getTeamClassifications'])->name('archive-get-work-team-classifications');
    Route::get('/work-team-classifications/search', function (Request $request) {
        $q = $request->get('q');

        $results = WorkTeamClassification::where('code', 'like', "%{$q}%")
                    ->orWhere('name', 'like', "%{$q}%")
                    // ->limit(20)
                    ->get(['id', 'code', 'name']);

        return response()->json($results);

    })->name('work_team_classifications.search');
    Route::post('/archive/{id}/update-status', [ArchiveController::class, 'updateStatus'])->name('archives.update-status');
    Route::post('/app/archive/bulk-update', [ArchiveController::class, 'bulkUpdate'])->name('archive-bulk-update');
    Route::post('/app/archive/bulk-delete', [ArchiveController::class, 'bulkDelete'])->name('archive-bulk-delete');


    /**
     * * Dashboard Routes *
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    /**
     * * Users Routes *
     */
    Route::resource('/user', UserController::class)->names([
        'index' => 'user.index',
        'create' => 'user.create',
        'show' => 'user.show',
        'store' => 'user.create-submit',
        'edit' => 'user.edit',
        'update' => 'user.edit-submit',
        'destroy' => 'user.delete',
    ]);


    /**
     * * Roles Routes *
     */
    Route::resource('/role', RoleController::class)->names([
        'index' => 'role.index',
        'create' => 'role.create',
        'show' => 'role.show',
        'store' => 'role.create-submit',
        'edit' => 'role.edit',
        'update' => 'role.edit-submit',
        'destroy' => 'role.delete',
    ]);


    /**
     * * Archive Access Level Routes *
     */
    Route::resource('/archive-access-level', ArchiveAccessLevelController::class)->names([
        'index' => 'archive-access-level.index',
        'create' => 'archive-access-level.create',
        'show' => 'archive-access-level.show',
        'store' => 'archive-access-level.create-submit',
        'edit' => 'archive-access-level.edit',
        'update' => 'archive-access-level.edit-submit',
        'destroy' => 'archive-access-level.delete',
    ]);


    /**
     * * Archive Condition Routes *
     */
    Route::resource('/archive-condition', ArchiveConditionController::class)->names([
        'index' => 'archive-condition.index',
        'create' => 'archive-condition.create',
        'show' => 'archive-condition.show',
        'store' => 'archive-condition.create-submit',
        'edit' => 'archive-condition.edit',
        'update' => 'archive-condition.edit-submit',
        'destroy' => 'archive-condition.delete',
    ]);


    /**
     * * Archive Development Level Routes *
     */
    Route::resource('/archive-development-level', ArchiveDevelopmentLevelController::class)->names([
        'index' => 'archive-development-level.index',
        'create' => 'archive-development-level.create',
        'show' => 'archive-development-level.show',
        'store' => 'archive-development-level.create-submit',
        'edit' => 'archive-development-level.edit',
        'update' => 'archive-development-level.edit-submit',
        'destroy' => 'archive-development-level.delete',
    ]);


    /**
     * * Archive Final Depreciation Action Routes *
     */
    Route::resource('/final-depreciation-action', ArchiveFinalDepreciationActionController::class)->names([
        'index' => 'final-depreciation-action.index',
        'create' => 'final-depreciation-action.create',
        'show' => 'final-depreciation-action.show',
        'store' => 'final-depreciation-action.create-submit',
        'edit' => 'final-depreciation-action.edit',
        'update' => 'final-depreciation-action.edit-submit',
        'destroy' => 'final-depreciation-action.delete',
    ]);


    /**
     * * Archive Media Routes *
     */
    Route::resource('/archive-media', ArchiveMediaController::class)->names([
        'index' => 'archive-media.index',
        'create' => 'archive-media.create',
        'show' => 'archive-media.show',
        'store' => 'archive-media.create-submit',
        'edit' => 'archive-media.edit',
        'update' => 'archive-media.edit-submit',
        'destroy' => 'archive-media.delete',
    ]);


    /**
     * * Archive Public Access Level Routes *
     */
    Route::resource('/public-access-level', ArchivePublicAccessLevelController::class)->names([
        'index' => 'public-access-level.index',
        'create' => 'public-access-level.create',
        'show' => 'public-access-level.show',
        'store' => 'public-access-level.create-submit',
        'edit' => 'public-access-level.edit',
        'update' => 'public-access-level.edit-submit',
        'destroy' => 'public-access-level.delete',
    ]);


    /**
     * * Archive Quantity Unit Routes *
     */
    Route::resource('/quantity-unit', ArchiveQuantityUnitController::class)->names([
        'index' => 'quantity-unit.index',
        'create' => 'quantity-unit.create',
        'show' => 'quantity-unit.show',
        'store' => 'quantity-unit.create-submit',
        'edit' => 'quantity-unit.edit',
        'update' => 'quantity-unit.edit-submit',
        'destroy' => 'quantity-unit.delete',
    ]);


    /**
     * * Archive Retention Routes *
     */
    Route::resource('/archive-retention', ArchiveRetentionController::class)->names([
        'index' => 'archive-retention.index',
        'create' => 'archive-retention.create',
        'show' => 'archive-retention.show',
        'store' => 'archive-retention.create-submit',
        'edit' => 'archive-retention.edit',
        'update' => 'archive-retention.edit-submit',
        'destroy' => 'archive-retention.delete',
    ]);

    
    /**
     * * Archive Security Classification Routes *
     */
    Route::resource('/security-classification', ArchiveSecurityClassificationController::class)->names([
        'index' => 'security-classification.index',
        'create' => 'security-classification.create',
        'show' => 'security-classification.show',
        'store' => 'security-classification.create-submit',
        'edit' => 'security-classification.edit',
        'update' => 'security-classification.edit-submit',
        'destroy' => 'security-classification.delete',
    ]);

    
    /**
     * * Archive Types Routes *
     */
    Route::resource('/archive-type', ArchiveTypeController::class)->names([
        'index' => 'archive-type.index',
        'create' => 'archive-type.create',
        'show' => 'archive-type.show',
        'store' => 'archive-type.create-submit',
        'edit' => 'archive-type.edit',
        'update' => 'archive-type.edit-submit',
        'destroy' => 'archive-type.delete',
    ]);
    

    /**
     * * Archive Subtype Routes *
     */
    Route::resource('/archive-subtype', ArchiveSubTypeController::class)->names([
        'index' => 'archive-subtype.index',
        'create' => 'archive-subtype.create',
        'show' => 'archive-subtype.show',
        'store' => 'archive-subtype.create-submit',
        'edit' => 'archive-subtype.edit',
        'update' => 'archive-subtype.edit-submit',
        'destroy' => 'archive-subtype.delete',
    ]);


    /**
     * * Archive Status Routes *
     */
    Route::resource('/archive-status', ArchiveStatusController::class)->names([
        'index' => 'archive-status.index',
        'create' => 'archive-status.create',
        'show' => 'archive-status.show',
        'store' => 'archive-status.create-submit',
        'edit' => 'archive-status.edit',
        'update' => 'archive-status.edit-submit',
        'destroy' => 'archive-status.delete',
    ]);


    /**
     * * Work Unit Routes *
     */
    Route::resource('/work-unit', WorkUnitController::class)->names([
        'index' => 'work-unit.index',
        'create' => 'work-unit.create',
        'show' => 'work-unit.show',
        'store' => 'work-unit.create-submit',
        'edit' => 'work-unit.edit',
        'update' => 'work-unit.edit-submit',
        'destroy' => 'work-unit.delete',
    ]);


    /**
     * * Work Group Routes *
     */
    Route::resource('/work-group', WorkGroupController::class)->names([
        'index' => 'work-group.index',
        'create' => 'work-group.create',
        'show' => 'work-group.show',
        'store' => 'work-group.create-submit',
        'edit' => 'work-group.edit',
        'update' => 'work-group.edit-submit',
        'destroy' => 'work-group.delete',
    ]);


    /**
     * * Work Team Routes *
     */
    Route::resource('/work-team', WorkTeamController::class)->names([
        'index' => 'work-team.index',
        'create' => 'work-team.create',
        'show' => 'work-team.show',
        'store' => 'work-team.create-submit',
        'edit' => 'work-team.edit',
        'update' => 'work-team.edit-submit',
        'destroy' => 'work-team.delete',
    ]);


    /**
     * * Work Team Classification Routes *
     */
    Route::resource('/work-team-classification', WorkTeamClassificationController::class)->names([
        'index' => 'work-team-classification.index',
        'create' => 'work-team-classification.create',
        'show' => 'work-team-classification.show',
        'store' => 'work-team-classification.create-submit',
        'edit' => 'work-team-classification.edit',
        'update' => 'work-team-classification.edit-submit',
        'destroy' => 'work-team-classification.delete',
    ]);


    /**
     * * Archive Building Routes *
     */
    Route::resource('/archive-building', ArchiveBuildingController::class)->names([
        'index' => 'archive-building.index',
        'create' => 'archive-building.create',
        'show' => 'archive-building.show',
        'store' => 'archive-building.create-submit',
        'edit' => 'archive-building.edit',
        'update' => 'archive-building.edit-submit',
        'destroy' => 'archive-building.delete',
    ]);


    /**
     * * Archive Storage Location Routes *
     */
    Route::resource('/archive-storage-location', ArchiveStorageLocationController::class)->names([
        'index' => 'archive-storage-location.index',
        'create' => 'archive-storage-location.create',
        'show' => 'archive-storage-location.show',
        'store' => 'archive-storage-location.create-submit',
        'edit' => 'archive-storage-location.edit',
        'update' => 'archive-storage-location.edit-submit',
        'destroy' => 'archive-storage-location.delete',
    ]);


    /**
     * * Archive Shelf Row Routes *
     */
    Route::resource('/archive-shelf-row', ArchiveShelfRowController::class)->names([
        'index' => 'archive-shelf-row.index',
        'create' => 'archive-shelf-row.create',
        'show' => 'archive-shelf-row.show',
        'store' => 'archive-shelf-row.create-submit',
        'edit' => 'archive-shelf-row.edit',
        'update' => 'archive-shelf-row.edit-submit',
        'destroy' => 'archive-shelf-row.delete',
    ]);


    /**
     * * Archive Box Routes *
     */
    Route::resource('/archive-box', ArchiveBoxController::class)->names([
        'index' => 'archive-box.index',
        'create' => 'archive-box.create',
        'show' => 'archive-box.show',
        'store' => 'archive-box.create-submit',
        'edit' => 'archive-box.edit',
        'update' => 'archive-box.edit-submit',
        'destroy' => 'archive-box.delete',
    ]);


    /**
     * * Archive Folder Routes *
     */
    Route::resource('/archive-folder', ArchiveFolderController::class)->names([
        'index' => 'archive-folder.index',
        'create' => 'archive-folder.create',
        'show' => 'archive-folder.show',
        'store' => 'archive-folder.create-submit',
        'edit' => 'archive-folder.edit',
        'update' => 'archive-folder.edit-submit',
        'destroy' => 'archive-folder.delete',
    ]);

    /**
     * * Report Routes *
     */
    Route::get('/archive-report', [ArchiveReportController::class, 'index'])->name('archive-report.index');
    Route::get('/archive-report-filter', [ArchiveReportController::class, 'filter'])->name('archive-report.filter');

    /**
     * * Export Routes *
     */
    Route::get('/app/export-excel', [ArchiveReportController::class, 'exportExcel'])->name('archive-report.export.excel');
    Route::get('/app/export-pdf', [ArchiveReportController::class, 'generatePdf'])->name('archive-report.export.pdf');

    /**
     * * Import Excel Routes *
     */
    Route::get('/app/import-excel', [ImportArchiveController::class, 'index'])->name('import-excel.index');
    Route::post('/app/import-excel', [ImportArchiveController::class, 'upload'])->name('import-excel.upload');
});

