<?php

use App\Http\Controllers\ArchiveAccessLevelController;
use App\Http\Controllers\ArchiveConditionController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ArchiveDevelopmentLevelController;
use App\Http\Controllers\ArchiveFinalDepreciationActionController;
use App\Http\Controllers\ArchiveMediaController;
use App\Http\Controllers\ArchivePublicAccessLevelController;
use App\Http\Controllers\ArchiveQuantityUnitController;
use App\Http\Controllers\ArchiveRetentionController;
use App\Http\Controllers\ArchiveSecurityClassificationController;
use App\Http\Controllers\DashboardController;
use App\Models\ArchiveCondition;
use App\Models\ArchiveFinalDepreciationAction;
use App\Models\ArchiveMedia;
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


    /**
     * * Dashboard Routes *
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


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
});