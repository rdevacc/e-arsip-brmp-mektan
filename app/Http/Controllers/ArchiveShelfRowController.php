<?php

namespace App\Http\Controllers;

use App\Models\ArchiveShelfRow;
use App\Models\ArchiveStorageLocation;
use Illuminate\Http\Request;

class ArchiveShelfRowController extends Controller
{
    public function index(){
        $archiveShelfRows = ArchiveShelfRow::with('archive_storage_place')->get(['id', 'archive_storage_place_id', 'name']);
        
        return view('apps.archive-shelf-row.index', compact('archiveShelfRows'));
    }

    public function create(){
        $archiveStorageLocations = ArchiveStorageLocation::get(['id', 'name']);

        return view('apps.archive-shelf-row.create', compact('archiveStorageLocations'));
    }

    public function store(Request $request){
         $validated = $request->validate([
             'archive_storage_location_id' => 'required',
             'name' => 'required'
         ],[
            'archive_storage_location_id.required' => 'Lokasi Penyimpanan Arsip field is required!',
            'name.required' => 'Nama Baris Lokasi Penyimpanan Arsip field is required!',
         ]
        );

        ArchiveShelfRow::create($validated);

        return redirect()->route('archive-shelf-row.index')->with('success', 'Data Baris Lokasi Penyimpanan Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveShelfRow $archive_shelf_row){
        $archiveStorageLocations = ArchiveStorageLocation::get(['id', 'name']);

        return view('apps.archive-shelf-row.edit', compact('archive_shelf_row', 'archiveStorageLocations'));
    }

    public function update(Request $request, ArchiveShelfRow $archive_shelf_row){
         $validated = $request->validate([
             'archive_storage_location_id' => 'required',
             'name' => 'required'
         ],[
            'archive_storage_location_id.required' => 'Lokasi Penyimpanan Arsip field is required!',
            'name.required' => 'Nama Baris Lokasi Penyimpanan Arsip field is required!',
         ]
        );

        ArchiveShelfRow::where('id', $archive_shelf_row->id)->update($validated);

        return redirect()->route('archive-shelf-row.index')->with('success', 'Data Baris Lokasi Penyimpanan Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveShelfRow $archive_shelf_row){
        // Destroy data by id
        ArchiveShelfRow::destroy($archive_shelf_row->id);

        return redirect()->route('archive-shelf-row.index')->with('success', 'Data Baris Lokasi Penyimpanan Arsip Berhasil Dihapus');
    }
}
