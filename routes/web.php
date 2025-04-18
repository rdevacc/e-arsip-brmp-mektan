<?php

use App\Http\Controllers\ArchiveController;
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
     * * Archive Route *
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
});