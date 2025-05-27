<?php

namespace App\Http\Controllers;

use App\Models\ArchiveFinalDepreciationAction;
use Illuminate\Http\Request;

class ArchiveFinalDepreciationActionController extends Controller
{
    public function index(){
        $archiveFinalDepreciationActions = ArchiveFinalDepreciationAction::get(['id', 'name']);

        return view('apps.archive-final-depreciation-action.index', compact('archiveFinalDepreciationActions'));
    }

    public function create(){
        return view('apps.archive-final-depreciation-action.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Tindakan Penyusutan Akhir Arsip field is required!',
         ]
        );

        ArchiveFinalDepreciationAction::create($validated);

        return redirect()->route('final-depreciation-action.index')->with('success', 'Data Tindakan Penyusutan Akhir Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveFinalDepreciationAction $final_depreciation_action){

        return view('apps.archive-final-depreciation-action.edit', compact('final_depreciation_action'));
    }

    public function update(Request $request, ArchiveFinalDepreciationAction $final_depreciation_action){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Tindakan Penyusutan Akhir Arsip field is required!',
         ]
        );

        ArchiveFinalDepreciationAction::where('id', $final_depreciation_action->id)->update($validated);

        return redirect()->route('final-depreciation-action.index')->with('success', 'Data Tindakan Penyusutan Akhir Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveFinalDepreciationAction $final_depreciation_action){
        // Destroy data by id
        ArchiveFinalDepreciationAction::destroy($final_depreciation_action->id);

        return redirect()->route('final-depreciation-action.index')->with('success', 'Data Tindakan Penyusutan Akhir Arsip Berhasil Dihapus');
    }
}
