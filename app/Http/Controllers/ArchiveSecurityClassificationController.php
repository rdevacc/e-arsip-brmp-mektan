<?php

namespace App\Http\Controllers;

use App\Models\ArchiveSecurityClassification;
use Illuminate\Http\Request;

class ArchiveSecurityClassificationController extends Controller
{
    public function index(){
        $archiveSecurityClassifications = ArchiveSecurityClassification::get(['id', 'name']);

        return view('apps.archive-security-classification.index', compact('archiveSecurityClassifications'));
    }

    public function create(){
        return view('apps.archive-security-classification.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Klasifikasi Keamanan Arsip field is required!',
         ]
        );

        ArchiveSecurityClassification::create($validated);

        return redirect()->route('security-classification.index')->with('success', 'Data Klasifikasi Keamanan Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveSecurityClassification $security_classification){

        return view('apps.archive-security-classification.edit', compact('security_classification'));
    }

    public function update(Request $request, ArchiveSecurityClassification $security_classification){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Klasifikasi Keamanan Arsip field is required!',
         ]
        );

        ArchiveSecurityClassification::where('id', $security_classification->id)->update($validated);

        return redirect()->route('security-classification.index')->with('success', 'Data Klasifikasi Keamanan Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveSecurityClassification $security_classification){
        // Destroy data by id
        ArchiveSecurityClassification::destroy($security_classification->id);

        return redirect()->route('security-classification.index')->with('success', 'Data Klasifikasi Keamanan Arsip Berhasil Dihapus');
    }
}
