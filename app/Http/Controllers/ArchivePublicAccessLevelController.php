<?php

namespace App\Http\Controllers;

use App\Models\ArchivePublicAccessLevel;
use Illuminate\Http\Request;

class ArchivePublicAccessLevelController extends Controller
{
    public function index(){
        $archivePublicAccessLevels = ArchivePublicAccessLevel::get(['id', 'name']);

        return view('apps.archive-public-access-level.index', compact('archivePublicAccessLevels'));
    }

    public function create(){
        return view('apps.archive-public-access-level.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Tingkat Akes Publik Arsip field is required!',
         ]
        );

        ArchivePublicAccessLevel::create($validated);

        return redirect()->route('public-access-level.index')->with('success', 'Data Tingkat Akes Publik Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchivePublicAccessLevel $public_access_level){

        return view('apps.archive-public-access-level.edit', compact('public_access_level'));
    }

    public function update(Request $request, ArchivePublicAccessLevel $public_access_level){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Tingkat Akes Publik Arsip field is required!',
         ]
        );

        ArchivePublicAccessLevel::where('id', $public_access_level->id)->update($validated);

        return redirect()->route('public-access-level.index')->with('success', 'Data Tingkat Akes Publik Arsip Berhasil Diupdate');
    }

    public function destroy(ArchivePublicAccessLevel $public_access_level){
        // Destroy data by id
        ArchivePublicAccessLevel::destroy($public_access_level->id);

        return redirect()->route('public-access-level.index')->with('success', 'Data Tingkat Akes Publik Arsip Berhasil Dihapus');
    }
}