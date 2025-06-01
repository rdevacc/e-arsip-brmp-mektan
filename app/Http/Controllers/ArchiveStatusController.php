<?php

namespace App\Http\Controllers;

use App\Models\ArchiveStatus;
use Illuminate\Http\Request;

class ArchiveStatusController extends Controller
{
    public function index(){
        $archiveStatuses = ArchiveStatus::get(['id', 'name']);

        return view('apps.archive-status.index', compact('archiveStatuses'));
    }

    public function create(){
        return view('apps.archive-status.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Status Arsip field is required!',
         ]
        );

        ArchiveStatus::create($validated);

        return redirect()->route('archive-status.index')->with('success', 'Data Status Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveStatus $archive_status){

        return view('apps.archive-status.edit', compact('archive_status'));
    }

    public function update(Request $request, ArchiveStatus $archive_status){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Status Arsip field is required!',
         ]
        );

        ArchiveStatus::where('id', $archive_status->id)->update($validated);

        return redirect()->route('archive-status.index')->with('success', 'Data Status Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveStatus $archive_status){
        // Destroy data by id
        ArchiveStatus::destroy($archive_status->id);

        return redirect()->route('archive-status.index')->with('success', 'Data Status Arsip Berhasil Dihapus');
    }
}
