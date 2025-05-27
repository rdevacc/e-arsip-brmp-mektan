<?php

namespace App\Http\Controllers;

use App\Models\ArchiveQuantityUnit;
use Illuminate\Http\Request;

class ArchiveQuantityUnitController extends Controller
{
    public function index(){
        $archiveQuantityUnits = ArchiveQuantityUnit::get(['id', 'name']);

        return view('apps.archive-quantity-unit.index', compact('archiveQuantityUnits'));
    }

    public function create(){
        return view('apps.archive-quantity-unit.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Satuan Kuantitas Arsip field is required!',
         ]
        );

        ArchiveQuantityUnit::create($validated);

        return redirect()->route('quantity-unit.index')->with('success', 'Data Satuan Kuantitas Arsip Baru Berhasil Ditambahkan');

    }

    public function edit(ArchiveQuantityUnit $quantity_unit){

        return view('apps.archive-quantity-unit.edit', compact('quantity_unit'));
    }

    public function update(Request $request, ArchiveQuantityUnit $quantity_unit){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Satuan Kuantitas Arsip field is required!',
         ]
        );

        ArchiveQuantityUnit::where('id', $quantity_unit->id)->update($validated);

        return redirect()->route('quantity-unit.index')->with('success', 'Data Satuan Kuantitas Arsip Berhasil Diupdate');
    }

    public function destroy(ArchiveQuantityUnit $quantity_unit){
        // Destroy data by id
        ArchiveQuantityUnit::destroy($quantity_unit->id);

        return redirect()->route('quantity-unit.index')->with('success', 'Data Satuan Kuantitas Arsip Berhasil Dihapus');
    }
}