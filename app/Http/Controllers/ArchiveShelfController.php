<?php

namespace App\Http\Controllers;

use App\Models\ArchiveCabinet;
use App\Models\ArchiveShelf;
use Illuminate\Http\Request;

class ArchiveShelfController extends Controller
{
    public function index(){
        $archiveShelves = ArchiveShelf::with('archive_cabinet')->get(['id', 'archive_cabinet_id', 'name']);
        
        return view('apps.archive-shelf.index', compact('archiveShelves'));
    }

    public function create(){
        $archiveCabinets = ArchiveCabinet::get(['id', 'name']);

        return view('apps.archive-shelf.create', compact('archiveCabinets'));
    }

    public function store(Request $request){
         $validated = $request->validate([
             'archive_cabinet_id' => 'required',
             'name' => 'required'
         ],[
            'archive_cabinet_id.required' => 'Lemari Arsip field is required!',
            'name.required' => 'Nama Rak Lemari Arsip field is required!',
         ]
        );

        ArchiveShelf::create($validated);

        return redirect()->route('archive-shelf.index')->with('success', 'Data Rak Lemari Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveShelf $archive_shelf){
        $archiveCabinets = ArchiveCabinet::get(['id', 'name']);

        return view('apps.archive-shelf.edit', compact('archive_shelf', 'archiveCabinets'));
    }

    public function update(Request $request, ArchiveShelf $archive_shelf){
         $validated = $request->validate([
             'archive_cabinet_id' => 'required',
             'name' => 'required'
         ],[
            'archive_cabinet_id.required' => 'Lemari Arsip field is required!',
            'name.required' => 'Nama Rak Lemari Arsip field is required!',
         ]
        );

        ArchiveShelf::where('id', $archive_shelf->id)->update($validated);

        return redirect()->route('archive-shelf.index')->with('success', 'Data Rak Lemari Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveShelf $archive_shelf){
        // Destroy data by id
        ArchiveShelf::destroy($archive_shelf->id);

        return redirect()->route('archive-shelf.index')->with('success', 'Data Rak Lemari Arsip Berhasil Dihapus');
    }
}
