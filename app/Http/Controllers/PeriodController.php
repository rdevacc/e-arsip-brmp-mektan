<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
   public function index(){
        $periods = Period::get(['id', 'name']);

        return view('apps.period.index', compact('periods'));
    }

    public function create(){
        return view('apps.period.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Periode field is required!',
         ]
        );

        Period::create($validated);

        return redirect()->route('archive-condition.index')->with('success', 'Data Periode Baru Berhasil Ditambahkan');

    }

    public function edit(Period $period){

        return view('apps.period.edit', compact('period'));
    }

    public function update(Request $request, Period $period){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Periode field is required!',
         ]
        );

        Period::where('id', $period->id)->update($validated);

        return redirect()->route('archive-condition.index')->with('success', 'Data Periode Berhasil Diupdate');
    }

    public function destroy(Period $period){
        // Destroy data by id
        Period::destroy($period->id);

        return redirect()->route('archive-condition.index')->with('success', 'Data Periode Berhasil Dihapus');
    }
}
