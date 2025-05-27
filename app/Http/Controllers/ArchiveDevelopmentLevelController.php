<?php

namespace App\Http\Controllers;

use App\Models\ArchiveDevelopmentLevel;
use Illuminate\Http\Request;

class ArchiveDevelopmentLevelController extends Controller
{
    public function index(){
        $archiveDevelopmentLevels = ArchiveDevelopmentLevel::get(['id', 'name']);

        return view('apps.archive-development-level.index', compact('archiveDevelopmentLevels'));
    }

    public function create(){
        return view('apps.archive-development-level.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Tingkat Perkembangan Arsip field is required!',
         ]
        );

        ArchiveDevelopmentLevel::create($validated);

        return redirect()->route('archive-development-level.index')->with('success', 'Data Tingkat Perkembangan Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveDevelopmentLevel $archive_development_level){

        return view('apps.archive-development-level.edit', compact('archive_development_level'));
    }

    public function update(Request $request, ArchiveDevelopmentLevel $archive_development_level){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Tingkat Perkembangan Arsip field is required!',
         ]
        );

        ArchiveDevelopmentLevel::where('id', $archive_development_level->id)->update($validated);

        return redirect()->route('archive-development-level.index')->with('success', 'Data Tingkat Perkembangan Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveDevelopmentLevel $archive_development_level){
        // Destroy data by id
        ArchiveDevelopmentLevel::destroy($archive_development_level->id);

        return redirect()->route('archive-development-level.index')->with('success', 'Data Tingkat Perkembangan Arsip Berhasil Dihapus');
    }
}
