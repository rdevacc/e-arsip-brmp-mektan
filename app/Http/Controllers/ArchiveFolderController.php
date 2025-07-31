<?php

namespace App\Http\Controllers;


use App\Models\ArchiveFolder;
use App\Models\ArchiveStoragePlace;
use Illuminate\Http\Request;

class ArchiveFolderController extends Controller
{
    public function index(){
        $archiveFolders = ArchiveFolder::with('archive_storage_place')->get(['id', 'archive_storage_place_id', 'name']);
        
        return view('apps.archive-folder.index', compact('archiveFolders'));
    }

    public function create(){
        $archiveStoragePlaces = ArchiveStoragePlace::get(['id', 'name']);

        return view('apps.archive-folder.create', compact('archiveStoragePlaces'));
    }

    public function store(Request $request){
         $validated = $request->validate([
             'archive_storage_place_id' => 'required',
             'name' => 'required'
         ],[
            'archive_storage_place_id.required' => 'Tempat Penyimpanan Arsip field is required!',
            'name.required' => 'Nama Folder Arsip field is required!',
         ]
        );

        ArchiveFolder::create($validated);

        return redirect()->route('archive-folder.index')->with('success', 'Data Folder Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveFolder $archive_folder){
        $archiveStoragePlaces = ArchiveStoragePlace::get(['id', 'name']);

        return view('apps.archive-folder.edit', compact('archive_folder', 'archiveStoragePlaces'));
    }

    public function update(Request $request, ArchiveFolder $archive_folder){
         $validated = $request->validate([
             'archive_storage_place_id' => 'required',
             'name' => 'required'
         ],[
            'archive_storage_place_id.required' => 'Tempat Penyimpanan Arsip field is required!',
            'name.required' => 'Nama Folder Arsip field is required!',
         ]
        );

        ArchiveFolder::where('id', $archive_folder->id)->update($validated);

        return redirect()->route('archive-folder.index')->with('success', 'Data Folder Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveFolder $archive_folder){
        // Destroy data by id
        ArchiveFolder::destroy($archive_folder->id);

        return redirect()->route('archive-folder.index')->with('success', 'Data Folder Arsip Berhasil Dihapus');
    }
}
