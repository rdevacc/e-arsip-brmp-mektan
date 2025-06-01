<?php

namespace App\Http\Controllers;

use App\Models\WorkTeam;
use App\Models\WorkTeamClassification;
use Illuminate\Http\Request;

class WorkTeamClassificationController extends Controller
{
    public function index(){
        $workTeamClassifications = WorkTeamClassification::orderBy('code')->get(['id', 'work_team_id', 'name', 'code']);

        return view('apps.work-team-classification.index', compact('workTeamClassifications'));
    }

    public function create(){
        $workTeams = WorkTeam::get(['id', 'name']);

        return view('apps.work-team-classification.create', compact('workTeams'));
    }

    public function store(Request $request){
         $validated = $request->validate([
             'work_team_id' => 'required',
             'code' => 'required',
             'name' => 'required'
         ],[
            'work_team_id.required' => 'Tim Kerja field is required!',
            'code.required' => 'Kode Klasifikasi field is required!',
            'name.required' => 'Nama Kode Klasifikasi field is required!',
         ]
        );

        WorkTeamClassification::create($validated);

        return redirect()->route('work-team-classification.index')->with('success', 'Data Kode Klasifikasi Baru Berhasil Ditambahkan');

    }

    public function edit(WorkTeamClassification $work_team_classification){
        $workTeams = WorkTeam::get(['id', 'name']);

        return view('apps.work-team-classification.edit', compact('work_team_classification', 'workTeams'));
    }

    public function update(Request $request, WorkTeamClassification $work_team_classification){
        $validated = $request->validate([
             'work_team_id' => 'required',
             'code' => 'required',
             'name' => 'required'
         ],[
            'work_team_id.required' => 'Tim Kerja field is required!',
            'code.required' => 'Kode Klasifikasi field is required!',
            'name.required' => 'Nama Kode Klasifikasi field is required!',
         ]
        );

        WorkTeamClassification::where('id', $work_team_classification->id)->update($validated);

        return redirect()->route('work-team-classification.index')->with('success', 'Data Kode Klasifikasi Berhasil Diupdate');
    }

    public function destroy(WorkTeamClassification $work_team_classification){
        // Destroy data by id
        WorkTeamClassification::destroy($work_team_classification->id);

        return redirect()->route('work-team-classification.index')->with('success', 'Data Kode Klasifikasi Berhasil Dihapus');
    }
}