<?php

namespace App\Http\Controllers;

use App\Models\ArchiveBox;
use App\Models\ArchiveShelfRow;
use Illuminate\Http\Request;

class ArchiveBoxController extends Controller
{
    public function index(){
        $archiveBoxes = ArchiveBox::with('archive_shelf_row')->get(['id', 'archive_shelf_row_id', 'name']);
        
        return view('apps.archive-box.index', compact('archiveBoxes'));
    }

    public function create(){
        $archiveShelfRows = ArchiveShelfRow::get(['id', 'name']);

        return view('apps.archive-box.create', compact('archiveShelfRows'));
    }

    public function store(Request $request){
         $validated = $request->validate([
             'archive_shelf_row_id' => 'required',
             'name' => 'required'
         ],[
            'archive_shelf_row_id.required' => 'Baris Rak Lemari Arsip field is required!',
            'name.required' => 'Nama Box Arsip field is required!',
         ]
        );

        ArchiveBox::create($validated);

        return redirect()->route('archive-box.index')->with('success', 'Data Box Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveBox $archive_box){
        $archiveShelfRows = ArchiveShelfRow::get(['id', 'name']);

        return view('apps.archive-box.edit', compact('archive_box', 'archiveShelfRows'));
    }

    public function update(Request $request, ArchiveBox $archive_box){
         $validated = $request->validate([
             'archive_shelf_row_id' => 'required',
             'name' => 'required'
         ],[
            'archive_shelf_row_id.required' => 'Baris Rak Lemari Arsip field is required!',
            'name.required' => 'Nama Box Arsip field is required!',
         ]
        );

        ArchiveBox::where('id', $archive_box->id)->update($validated);

        return redirect()->route('archive-box.index')->with('success', 'Data Box Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveBox $archive_box){
        // Destroy data by id
        ArchiveBox::destroy($archive_box->id);

        return redirect()->route('archive-box.index')->with('success', 'Data Box Arsip Berhasil Dihapus');
    }
}
