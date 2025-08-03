<?php

namespace App\Http\Controllers;

use App\Models\ArchiveSubType;
use App\Models\ArchiveType;
use Illuminate\Http\Request;

class ArchiveSubTypeController extends Controller
{
    public function index(){
        $archiveSubTypes = ArchiveSubType::with('archive_type')->get(['id', 'archive_type_id', 'name']);
        
        return view('apps.archive-sub-type.index', compact('archiveSubTypes'));
    }

    public function create(){
        $archiveTypes = ArchiveType::get(['id', 'name']);

        return view('apps.archive-sub-type.create', compact('archiveTypes'));
    }

    public function store(Request $request){
         $validated = $request->validate([
             'archive_type_id' => 'required',
             'name' => 'required'
         ],[
            'archive_type_id.required' => 'Sub Jenis Arsip field is required!',
            'name.required' => 'Nama Sub Jenis Arsip field is required!',
         ]
        );

        ArchiveSubType::create($validated);

        return redirect()->route('archive-shelf.index')->with('success', 'Data Sub Jenis Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveSubType $archive_subtype){
        $archiveTypes = ArchiveType::get(['id', 'name']);

        return view('apps.archive-sub-type.edit', compact('archive_subtype', 'archiveTypes'));
    }

    public function update(Request $request, ArchiveSubType $archive_subtype){
         $validated = $request->validate([
             'archive_type_id' => 'required',
             'name' => 'required'
         ],[
            'archive_type_id.required' => 'Sub Jenis Arsip field is required!',
            'name.required' => 'Nama Sub Jenis Arsip field is required!',
         ]
        );

        ArchiveSubType::where('id', $archive_subtype->id)->update($validated);

        return redirect()->route('archive-subtype.index')->with('success', 'Data Sub Jenis Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveSubType $archive_subtype){
        // Destroy data by id
        ArchiveSubType::destroy($archive_subtype->id);

        return redirect()->route('archive-subtype.index')->with('success', 'Data Sub Jenis Arsip Berhasil Dihapus');
    }
}
