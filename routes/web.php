<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\DashboardController;
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
                    ->limit(20)
                    ->get(['id', 'code', 'name']);

        return response()->json($results);

    })->name('work_team_classifications.search');

    /**
     * * Dashboard Routes *
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});