<?php

namespace App\Http\Controllers;

use App\Models\WorkUnit;
use Illuminate\Http\Request;

class WorkUnitController extends Controller
{
    public function index(){
        $workUnits = WorkUnit::get(['id', 'name']);

        return view('apps.work-unit.index', compact('workUnits'));
    }

    public function create(){
        return view('apps.work-unit.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Unit Kerja field is required!',
         ]
        );

        WorkUnit::create($validated);

        return redirect()->route('work-unit.index')->with('success', 'Data Unit Kerja Baru Berhasil Ditambahkan');

    }

    public function edit(WorkUnit $work_unit){

        return view('apps.work-unit.edit', compact('work_unit'));
    }

    public function update(Request $request, WorkUnit $work_unit){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Unit Kerja field is required!',
         ]
        );

        WorkUnit::where('id', $work_unit->id)->update($validated);

        return redirect()->route('work-unit.index')->with('success', 'Data Unit Kerja Berhasil Diupdate');
    }

    public function destroy(WorkUnit $work_unit){
        // Destroy data by id
        WorkUnit::destroy($work_unit->id);

        return redirect()->route('work-unit.index')->with('success', 'Data Unit Kerja Berhasil Dihapus');
    }
}

