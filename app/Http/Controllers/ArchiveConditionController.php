<?php

namespace App\Http\Controllers;

use App\Models\ArchiveCondition;
use Illuminate\Http\Request;

class ArchiveConditionController extends Controller
{
   public function index(){
        $ArchiveConditions = ArchiveCondition::get(['id', 'name']);

        return view('apps.archive-condition.index', compact('ArchiveConditions'));
    }

    public function create(){
        return view('apps.archive-condition.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Kondisi Arsip field is required!',
         ]
        );

        ArchiveCondition::create($validated);

        return redirect()->route('archive-condition.index')->with('success', 'Data Kondisi Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveCondition $archive_condition){

        return view('apps.archive-condition.edit', compact('archive_condition'));
    }

    public function update(Request $request, ArchiveCondition $archive_condition){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Kondisi Arsip field is required!',
         ]
        );

        ArchiveCondition::where('id', $archive_condition->id)->update($validated);

        return redirect()->route('archive-condition.index')->with('success', 'Data Kondisi Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveCondition $archive_condition){
        // Destroy data by id
        ArchiveCondition::destroy($archive_condition->id);

        return redirect()->route('archive-condition.index')->with('success', 'Data Kondisi Arsip Berhasil Dihapus');
    }
}
