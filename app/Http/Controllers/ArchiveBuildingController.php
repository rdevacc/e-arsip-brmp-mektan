<?php

namespace App\Http\Controllers;

use App\Models\ArchiveBuilding;
use Illuminate\Http\Request;

class ArchiveBuildingController extends Controller
{
    public function index(){
        $archive_buildings = ArchiveBuilding::get(['id', 'name']);

        return view('apps.archive-building.index', compact('archive_buildings'));
    }

    public function create(){
        return view('apps.archive-building.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Gedung Arsip field is required!',
         ]
        );

        ArchiveBuilding::create($validated);

        return redirect()->route('archive-building.index')->with('success', 'Data Gedung Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveBuilding $archive_building){

        return view('apps.archive-building.edit', compact('archive_building'));
    }

    public function update(Request $request, ArchiveBuilding $archive_building){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Gedung Arsip field is required!',
         ]
        );

        ArchiveBuilding::where('id', $archive_building->id)->update($validated);

        return redirect()->route('archive-building.index')->with('success', 'Data Gedung Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveBuilding $archive_building){
        // Destroy data by id
        ArchiveBuilding::destroy($archive_building->id);

        return redirect()->route('archive-building.index')->with('success', 'Data Gedung Arsip Berhasil Dihapus');
    }
}
