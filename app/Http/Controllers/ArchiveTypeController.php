<?php

namespace App\Http\Controllers;

use App\Models\ArchiveType;
use Illuminate\Http\Request;

class ArchiveTypeController extends Controller
{
    public function index(){
        $archiveTypes = ArchiveType::get(['id', 'name']);

        return view('apps.archive-type.index', compact('archiveTypes'));
    }

    public function create(){
        return view('apps.archive-type.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Jenis Arsip field is required!',
         ]
        );

        ArchiveType::create($validated);

        return redirect()->route('archive-type.index')->with('success', 'Data Jenis Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveType $archive_type){

        return view('apps.archive-type.edit', compact('archive_type'));
    }

    public function update(Request $request, ArchiveType $archive_type){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Jenis Arsip field is required!',
         ]
        );

        ArchiveType::where('id', $archive_type->id)->update($validated);

        return redirect()->route('archive-type.index')->with('success', 'Data Jenis Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveType $archive_type){
        // Destroy data by id
        ArchiveType::destroy($archive_type->id);

        return redirect()->route('archive-type.index')->with('success', 'Data Jenis Arsip Berhasil Dihapus');
    }
}
