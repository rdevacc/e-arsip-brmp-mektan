<?php

namespace App\Http\Controllers;

use App\Models\ArchiveCabinet;
use App\Models\ArchiveBuilding;
use Illuminate\Http\Request;

class ArchiveCabinetController extends Controller
{
    public function index(){
        $archiveCabinets = ArchiveCabinet::with('archive_building')->get(['id', 'archive_building_id', 'name']);
        
        return view('apps.archive-cabinet.index', compact('archiveCabinets'));
    }

    public function create(){
        $archiveBuildings = ArchiveBuilding::get(['id', 'name']);

        return view('apps.archive-cabinet.create', compact('archiveBuildings'));
    }

    public function store(Request $request){
         $validated = $request->validate([
             'archive_building_id' => 'required',
             'name' => 'required'
         ],[
            'archive_building_id.required' => 'Gedung Arsip field is required!',
            'name.required' => 'Nama Lemari Arsip field is required!',
         ]
        );

        ArchiveCabinet::create($validated);

        return redirect()->route('archive-cabinet.index')->with('success', 'Data Lemari Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveCabinet $archive_cabinet){
        $archiveBuildings = ArchiveBuilding::get(['id', 'name']);

        return view('apps.archive-cabinet.edit', compact('archive_cabinet', 'archiveBuildings'));
    }

    public function update(Request $request, ArchiveCabinet $archive_cabinet){
         $validated = $request->validate([
             'archive_building_id' => 'required',
             'name' => 'required'
         ],[
            'archive_building_id.required' => 'Gedung Arsip field is required!',
            'name.required' => 'Nama Lemari Arsip field is required!',
         ]
        );

        ArchiveCabinet::where('id', $archive_cabinet->id)->update($validated);

        return redirect()->route('archive-cabinet.index')->with('success', 'Data Lemari Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveCabinet $archive_cabinet){
        // Destroy data by id
        ArchiveCabinet::destroy($archive_cabinet->id);

        return redirect()->route('archive-cabinet.index')->with('success', 'Data Lemari Arsip Berhasil Dihapus');
    }
}
