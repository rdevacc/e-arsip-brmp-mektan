<?php

namespace App\Http\Controllers;

use App\Models\ArchiveStorageLocation;
use App\Models\ArchiveStoragePlace;
use Illuminate\Http\Request;

class ArchiveStoragePlaceController extends Controller
{
    public function index(){
        $archiveStoragePlaces = ArchiveStoragePlace::with('archive_storage_location')->get(['id', 'archive_storage_location_id', 'name']);
        
        return view('apps.archive-storage-place.index', compact('archiveStoragePlaces'));
    }

    public function create(){
        $archiveStorageLocations = ArchiveStorageLocation::get(['id', 'name']);

        return view('apps.archive-storage-place.create', compact('archiveStorageLocations'));
    }

    public function store(Request $request){
         $validated = $request->validate([
             'archive_storage_location_id' => 'required',
             'name' => 'required'
         ],[
            'archive_storage_location_id.required' => 'Lokasi Penyimpanan Arsip field is required!',
            'name.required' => 'Nama Tempat Penyimpanan Arsip field is required!',
         ]
        );

        ArchiveStorageLocation::create($validated);

        return redirect()->route('archive-storage-location.index')->with('success', 'Data Tempat Penyimpanan Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveStorageLocation $archive_storage_location){
        $archiveStorageLocations = archiveStorageLocation::get(['id', 'name']);

        return view('apps.archive-storage-place.edit', compact('archive_storage_location', 'archiveStorageLocations'));
    }

    public function update(Request $request, ArchiveStorageLocation $archive_storage_location){
         $validated = $request->validate([
             'archive_storage_location_id' => 'required',
             'name' => 'required'
         ],[
            'archive_storage_location_id.required' => 'Lokasi Penyimpanan Arsip field is required!',
            'name.required' => 'Nama Tempat Penyimpanan Arsip field is required!',
         ]
        );

        ArchiveStorageLocation::where('id', $archive_storage_location->id)->update($validated);

        return redirect()->route('archive-storage-location.index')->with('success', 'Data Tempat Penyimpanan Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveStorageLocation $archive_storage_location){
        // Destroy data by id
        ArchiveStorageLocation::destroy($archive_storage_location->id);

        return redirect()->route('archive-storage-location.index')->with('success', 'Data Tempat Penyimpanan Arsip Berhasil Dihapus');
    }
}
