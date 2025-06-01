<?php

namespace App\Http\Controllers;

use App\Models\ArchiveShelf;
use App\Models\ArchiveShelfRow;
use Illuminate\Http\Request;

class ArchiveShelfRowController extends Controller
{
    public function index(){
        $archiveShelfRows = ArchiveShelfRow::with('archive_shelf')->get(['id', 'archive_shelf_id', 'name']);
        
        return view('apps.archive-shelf-row.index', compact('archiveShelfRows'));
    }

    public function create(){
        $archiveShelves = ArchiveShelf::get(['id', 'name']);

        return view('apps.archive-shelf-row.create', compact('archiveShelves'));
    }

    public function store(Request $request){
         $validated = $request->validate([
             'archive_shelf_id' => 'required',
             'name' => 'required'
         ],[
            'archive_shelf_id.required' => 'Rak Lemari Arsip field is required!',
            'name.required' => 'Nama Baris Rak Lemari Arsip field is required!',
         ]
        );

        ArchiveShelfRow::create($validated);

        return redirect()->route('archive-shelf-row.index')->with('success', 'Data Baris Rak Lemari Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveShelfRow $archive_shelf_row){
        $archiveShelves = ArchiveShelf::get(['id', 'name']);

        return view('apps.archive-shelf-row.edit', compact('archive_shelf_row', 'archiveShelves'));
    }

    public function update(Request $request, ArchiveShelfRow $archive_shelf_row){
         $validated = $request->validate([
             'archive_shelf_id' => 'required',
             'name' => 'required'
         ],[
            'archive_shelf_id.required' => 'Rak Lemari Arsip field is required!',
            'name.required' => 'Nama Baris Rak Lemari Arsip field is required!',
         ]
        );

        ArchiveShelfRow::where('id', $archive_shelf_row->id)->update($validated);

        return redirect()->route('archive-shelf-row.index')->with('success', 'Data Baris Rak Lemari Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveShelfRow $archive_shelf_row){
        // Destroy data by id
        ArchiveShelfRow::destroy($archive_shelf_row->id);

        return redirect()->route('archive-shelf-row.index')->with('success', 'Data Baris Rak Lemari Arsip Berhasil Dihapus');
    }
}
