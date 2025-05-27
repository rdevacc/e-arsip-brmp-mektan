<?php

namespace App\Http\Controllers;

use App\Models\ArchiveMedia;
use Illuminate\Http\Request;

class ArchiveMediaController extends Controller
{
    public function index(){
        $archiveMedias = ArchiveMedia::get(['id', 'name']);

        return view('apps.archive-media.index', compact('archiveMedias'));
    }

    public function create(){
        return view('apps.archive-media.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Media Arsip field is required!',
         ]
        );

        ArchiveMedia::create($validated);

        return redirect()->route('archive-media.index')->with('success', 'Data Media Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveMedia $archive_medium){

        return view('apps.archive-media.edit', compact('archive_medium'));
    }

    public function update(Request $request, ArchiveMedia $archive_medium){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Media Arsip field is required!',
         ]
        );

        ArchiveMedia::where('id', $archive_medium->id)->update($validated);

        return redirect()->route('archive-media.index')->with('success', 'Data Media Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveMedia $archive_medium){
        // Destroy data by id
        ArchiveMedia::destroy($archive_medium->id);

        return redirect()->route('archive-media.index')->with('success', 'Data Media Arsip Berhasil Dihapus');
    }
}