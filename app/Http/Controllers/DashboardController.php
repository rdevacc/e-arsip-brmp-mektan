<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $totalArchive = Archive::count();
        $activeArchive = Archive::where('archive_subtype_id', 1)->count();
        $inactiveArchive = Archive::where('archive_subtype_id', 2)->count();
        $vitalArchive = Archive::where('archive_type_id', 4)->count();
        $permanentArchive = Archive::where('archive_type_id', 5)->count();
        $staticArchive = Archive::where('archive_type_id',2)->count();
        $dynamicArchive = Archive::where('archive_type_id',1)->count();
        $proposedForDestructionArchive = Archive::where('archive_status_id', 3)->count();
        $destructionArchive = Archive::where('archive_status_id', 4)->count();

        $dynamicArchivePercentage = 0;
        $staticArchivePercentage = 0;
        $permanentArchivePercentage = 0;
        $vitalArchivePercentage = 0;
       

        if ($totalArchive > 0) {
            // Perhitungan Persentase Arsip Dinamis
            $dynamicArchivePercentage = round(($dynamicArchive / $totalArchive) * 100, 2);

            // Perhitungan Persentase Arsip Statis
            $staticArchivePercentage = round(($staticArchive / $totalArchive) * 100, 2);

            // Perhitungan Persentase Arsip Permanen
            $permanentArchivePercentage = round(($permanentArchive / $totalArchive) * 100, 2);

            // Perhitungan Persentase Arsip Vital
            $vitalArchivePercentage = round(($vitalArchive / $totalArchive) * 100, 2);
        } else {
            $dynamicArchivePercentage = 0;
            $staticArchivePercentage = 0;
            $permanentArchivePercentage = 0;
            $vitalArchivePercentage = 0;
        }


        $chartLabels = ['Dinamis', 'Statis', 'Permanen', 'Vital'];
        $chartData = [
            $dynamicArchive,
            $staticArchive,
            $permanentArchive,
            $vitalArchive,
        ];

        return view('apps.dashboard.index', compact([
            'totalArchive',
            'activeArchive',
            'inactiveArchive',
            'staticArchive',
            'dynamicArchive',
            'vitalArchive',
            'permanentArchive',
            'proposedForDestructionArchive',
            'destructionArchive',
            'chartLabels',
            'chartData',
            'dynamicArchivePercentage',
            'staticArchivePercentage',
            'permanentArchivePercentage',
            'vitalArchivePercentage',
        ]));
    }
}
