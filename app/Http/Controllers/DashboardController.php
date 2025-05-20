<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $totalArchive = Archive::count();
        $activeArchive = Archive::where('archive_status_id', 4)->count();
        $inactiveArchive = Archive::where('archive_status_id', 5)->count();
        $vitalArchive = Archive::where('archive_status_id', 1)->count();
        $preservedArchive = Archive::where('archive_status_id', 9)->count();
        $staticArchive = Archive::whereHas('archive_status', function($query){
            $query->where('type_id', 2);
        })->count();
        $proposedForDestructionArchive = Archive::where('archive_status_id', 7)->count();
        $destructionArchive = Archive::where('archive_status_id', 8)->count();


        $chartLabels = ['Aktif', 'Inaktif', 'Vital', 'Terjaga', 'Usul Musnah', 'Musnah'];
        $chartData = [
            $activeArchive,
            $inactiveArchive,
            $vitalArchive,
            $preservedArchive,
            $proposedForDestructionArchive,
            $destructionArchive
        ];

        return view('apps.dashboard.index', compact([
            'totalArchive',
            'activeArchive',
            'inactiveArchive',
            'vitalArchive',
            'preservedArchive',
            'staticArchive',
            'proposedForDestructionArchive',
            'destructionArchive',
            'chartLabels',
            'chartData'
        ]));
    }
}
