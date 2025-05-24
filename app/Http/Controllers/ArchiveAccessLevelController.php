<?php

namespace App\Http\Controllers;

use App\Models\ArchiveAccessLevel;
use Illuminate\Http\Request;

class ArchiveAccessLevelController extends Controller
{
    public function index(){
        $archiveAccessLevels = ArchiveAccessLevel::get(['id', 'name']);

        return view('apps.archive-access-level.index', compact('archiveAccessLevels'));
    }

    public function create(){
        return view('apps.archive-access-level.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Level Akses Arsip field is required!',
         ]
        );

        ArchiveAccessLevel::create($validated);

        return redirect()->route('archive-access-level.index')->with('success', 'Data Level Akses Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveAccessLevel $archive_access_level){

        return view('apps.archive-access-level.edit', compact('archive_access_level'));
    }

    public function update(Request $request, ArchiveAccessLevel $archive_access_level){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Level Akses Arsip field is required!',
         ]
        );

        ArchiveAccessLevel::where('id', $archive_access_level->id)->update($validated);

        return redirect()->route('archive-access-level.index')->with('success', 'Data Level Akses Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveAccessLevel $archive_access_level){
        // Destroy data by id
        ArchiveAccessLevel::destroy($archive_access_level->id);

        return redirect()->route('archive-access-level.index')->with('success', 'Data Level Akses Arsip Berhasil Dihapus');
    }
}
