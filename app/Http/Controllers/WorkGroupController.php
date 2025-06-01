<?php

namespace App\Http\Controllers;

use App\Models\WorkGroup;
use App\Models\WorkUnit;
use Illuminate\Http\Request;

class WorkGroupController extends Controller
{
    public function index(){
        $workGroups = WorkGroup::with('work_unit')->get(['id', 'work_unit_id', 'name']);

        return view('apps.work-group.index', compact('workGroups'));
    }

    public function create(){
        $workUnits = WorkUnit::get(['id', 'name']);

        return view('apps.work-group.create', compact('workUnits'));
    }

    public function store(Request $request){
         $validated = $request->validate([
             'work_unit_id' => 'required',
             'name' => 'required'
         ],[
            'work_unit_id.required' => 'Unit Kerja field is required!',
            'name.required' => 'Nama Kelompok Kerja field is required!',
         ]
        );

        WorkGroup::create($validated);

        return redirect()->route('work-group.index')->with('success', 'Data Kelompok Kerja Baru Berhasil Ditambahkan');

    }

    public function edit(WorkGroup $work_group){
        $workUnits = WorkUnit::get(['id', 'name']);

        return view('apps.work-group.edit', compact('work_group', 'workUnits'));
    }

    public function update(Request $request, WorkGroup $work_group){
         $validated = $request->validate([
             'work_unit_id' => 'required',
             'name' => 'required'
         ],[
            'work_unit_id.required' => 'Unit Kerja field is required!',
            'name.required' => 'Nama Kelompok Kerja field is required!',
         ]
        );

        WorkGroup::where('id', $work_group->id)->update($validated);

        return redirect()->route('work-group.index')->with('success', 'Data Kelompok Kerja Berhasil Diupdate');
    }

    public function destroy(WorkGroup $work_group){
        // Destroy data by id
        WorkGroup::destroy($work_group->id);

        return redirect()->route('work-group.index')->with('success', 'Data Kelompok Kerja Berhasil Dihapus');
    }
}
