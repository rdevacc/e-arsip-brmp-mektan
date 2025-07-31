<?php

namespace App\Http\Controllers;

use App\Models\ArchiveBuilding;
use App\Models\ArchiveStorageLocation;
use Illuminate\Http\Request;

class ArchiveStorageLocationController extends Controller
{
    public function index(){
        $archiveStorageLocations = ArchiveStorageLocation::with('archive_building')->get(['id', 'archive_building_id', 'name']);
        
        return view('apps.archive-storage-location.index', compact('archiveStorageLocations'));
    }

    public function create(){
        $archiveBuildings = ArchiveBuilding::get(['id', 'name']);

        return view('apps.archive-storage-location.create', compact('archiveBuildings'));
    }

    public function store(Request $request){
         $validated = $request->validate([
             'archive_building_id' => 'required',
             'name' => 'required'
         ],[
            'archive_building_id.required' => 'Gedung Arsip field is required!',
            'name.required' => 'Nama Lokasi Penyimpanan Arsip field is required!',
         ]
        );

        ArchiveStorageLocation::create($validated);

        return redirect()->route('archive-storage-location.index')->with('success', 'Data Lokasi Penyimpanan Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveStorageLocation $archive_storage_location){
        $archiveBuildings = ArchiveBuilding::get(['id', 'name']);

        return view('apps.archive-storage-location.edit', compact('archive_storage_location', 'archiveBuildings'));
    }

    public function update(Request $request, ArchiveStorageLocation $archive_storage_location){
         $validated = $request->validate([
             'archive_building_id' => 'required',
             'name' => 'required'
         ],[
            'archive_building_id.required' => 'Gedung Arsip field is required!',
            'name.required' => 'Nama Lokasi Penyimpanan Arsip field is required!',
         ]
        );

        ArchiveStorageLocation::where('id', $archive_storage_location->id)->update($validated);

        return redirect()->route('archive-storage-location.index')->with('success', 'Data Lokasi Penyimpanan Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveStorageLocation $archive_storage_location){
        // Destroy data by id
        ArchiveStorageLocation::destroy($archive_storage_location->id);

        return redirect()->route('archive-storage-location.index')->with('success', 'Data Lokasi Penyimpanan Arsip Berhasil Dihapus');
    }
}
