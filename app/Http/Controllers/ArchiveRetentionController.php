<?php

namespace App\Http\Controllers;

use App\Models\ArchiveRetention;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArchiveRetentionController extends Controller
{
    public function index(){
        $archiveRetentions = ArchiveRetention::orderBy('range_value')->get(['id', 'range_value']);

        return view('apps.archive-retention.index', compact('archiveRetentions'));
    }

    public function create(){
        return view('apps.archive-retention.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'range_value' => 'required|integer|digits_between:1,3|between:1,100|unique:archive_retentions,range_value',
        ], [
            'range_value.required' => 'Rentang Retensi Arsip field is required!',
            'range_value.unique' => 'Rentang Retensi Arsip already exists!',
            'range_value.integer' => 'Rentang Retensi Arsip field must be an integer!',
            'range_value.between' => 'Rentang Retensi Arsip must be between 1 and 100!',
            'range_value.digits_between' => 'Rentang Retensi Arsip max 3 digits!',
        ]);

        ArchiveRetention::create($validated);

        return redirect()->route('archive-retention.index')->with('success', 'Data Retensi Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveRetention $archive_retention){

        return view('apps.archive-retention.edit', compact('archive_retention'));
    }

    public function update(Request $request, ArchiveRetention $archive_retention)
    {
        $validated = $request->validate([
            'range_value' => [
                'required',
                'integer',
                'digits_between:1,3',
                'between:1,100',
                Rule::unique('archive_retentions', 'range_value')->ignore($archive_retention->id),
            ],
        ], [
            'range_value.required' => 'Rentang Retensi Arsip field is required!',
            'range_value.unique' => 'Rentang Retensi Arsip already exists!',
            'range_value.integer' => 'Rentang Retensi Arsip field must be an integer!',
            'range_value.between' => 'Rentang Retensi Arsip field must be between 1 and 100!',
            'range_value.digits_between' => 'Rentang Retensi Arsip field max 3 digits!',
        ]);

        // Jika nilainya sama, tidak usah update
        if ($archive_retention->range_value == $validated['range_value']) {
            return redirect()->route('archive-retention.index')
                ->with('success', 'Tidak ada perubahan data yang disimpan.');
        }

        // Lanjutkan update
        $archive_retention->update($validated);

        return redirect()->route('archive-retention.index')->with('success', 'Data Retensi Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveRetention $archive_retention){
        // Destroy data by id
        ArchiveRetention::destroy($archive_retention->id);

        return redirect()->route('archive-retention.index')->with('success', 'Data Retensi Arsip Berhasil Dihapus');
    }
}
