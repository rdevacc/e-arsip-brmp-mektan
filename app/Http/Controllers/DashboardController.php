<?php

namespace App\Http\Controllers;

use App\Models\Archive;

class DashboardController extends Controller
{
    public function index(){
        $totalArchive = Archive::count();
        $activeArchive = Archive::where('archive_subtype_id', 1)->count();
        $inactiveArchive = Archive::where('archive_subtype_id', 2)->count();
        $vitalArchive = Archive::where('archive_subtype_id', 3)->count();
        $permanentArchive = Archive::where('archive_subtype_id', 4)->count();
        $staticArchive = Archive::where('archive_type_id', 2)->count();
        $dynamicArchive = Archive::where('archive_type_id', 1)->count();
        $proposedForDestructionArchive = Archive::where('archive_status_id', 3)->count();
        $destructionArchive = Archive::where('archive_status_id', 4)->count();
        $savedDynamicArchive = Archive::where('archive_type_id', 1)->where('archive_status_id', 1)->count();
        $savedStaticArchive = Archive::where('archive_type_id', 2)->where('archive_status_id', 1)->count();
        $savedVitalArchive = Archive::where('archive_type_id', 3)->where('archive_status_id', 1)->count();
        $savedPermanentArchive = Archive::where('archive_type_id', 4)->where('archive_status_id', 1)->count();
        $submittedDynamicArchive = Archive::where('archive_type_id', 1)->where('archive_status_id', 2)->count();
        $submittedStaticArchive = Archive::where('archive_type_id', 2)->where('archive_status_id', 2)->count();
        $submittedPermanentArchive = Archive::where('archive_type_id', 5)->where('archive_status_id', 2)->count();
        $submittedVitalArchive = Archive::where('archive_type_id', 4)->where('archive_status_id', 2)->count();

                
        // ==============================
        // DATA UNTUK DIAGRAM BATANG
        // ==============================

        // Chart 1: Jumlah Arsip per Kategori
        $chartBar1 = [
            'labels' => ['Dinamis', 'Statis'],
            'data'   => [$dynamicArchive, $staticArchive],
        ];

        // Chart 2: Jumlah Arsip Berdasarkan Subtype
        $chartBar2 = [
            'labels' => ['Aktif', 'Inaktif', 'Permanen', 'Vital'],
            'data'   => [$activeArchive, $inactiveArchive, $permanentArchive, $vitalArchive],
        ];

        // Chart 3: Arsip Statis Disimpan vs Diserahkan
        $chartBar3 = [
            'labels' => ['Disimpan', 'Diserahkan'],
            'data'   => [$savedStaticArchive, $submittedStaticArchive],
        ];

        // $dynamicArchivePercentage = 0;
        // $staticArchivePercentage = 0;
        // $permanentArchivePercentage = 0;
        // $vitalArchivePercentage = 0;
        
        // $dynamicActivePercentage = 0;
        // $dynamicInactivePercentage = 0;
        
        // $staticSavedPercentage = 0;
        // $staticSubmittedPercentage = 0;
      

        // if ($totalArchive > 0) {
            // Perhitungan Persentase Arsip Dinamis
            // $dynamicArchivePercentage = round(($dynamicArchive / $totalArchive) * 100, 2);

            // Perhitungan Persentase Arsip Statis
            // $staticArchivePercentage = round(($staticArchive / $totalArchive) * 100, 2);

            // Perhitungan Persentase Arsip Permanen
            // $permanentArchivePercentage = round(($permanentArchive / $totalArchive) * 100, 2);

            // Perhitungan Persentase Arsip Vital
            // $vitalArchivePercentage = round(($vitalArchive / $totalArchive) * 100, 2);
        // } 
        
        // if (($dynamicArchive ?? 0) > 0) {
        //     $dynamicActivePercentage   = round((($activeArchive   ?? 0) / $dynamicArchive) * 100, 2);
        //     $dynamicInactivePercentage = round((($inactiveArchive ?? 0) / $dynamicArchive) * 100, 2);
        // } 
        
        // if (($staticArchive ?? 0) > 0) {
        //     $staticSavedPercentage   = round((($savedStaticArchive   ?? 0) / $staticArchive) * 100, 2);
        //     $staticSubmittedPercentage = round((($submittedStaticArchive ?? 0) / $staticArchive) * 100, 2);
        // } 

        
        // ==============================
        // DATA UNTUK DIAGRAM LINGKARAN
        // ==============================

        // $chartLabels1 = ['Dinamis', 'Statis'];
        // $chartData1 = [
        //     $dynamicArchive,
        //     $staticArchive,
        //     $permanentArchive,
        //     $vitalArchive,
        // ];

        // $chartLabels2 = ['Aktif', 'Inaktif', 'Permanen', 'Vital'];
        // $chartData2 = [
        //     $activeArchive,
        //     $inactiveArchive,
        //     $permanentArchive,
        //     $vitalArchive,
        // ];

        // $chartLabels3 = ['Disimpan', 'Diserahkan'];
        // $chartData3 = [
        //     $savedStaticArchive,
        //     $submittedStaticArchive,
        // ];

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
            // 'chartLabels1',
            // 'chartData1',
            // 'chartLabels2',
            // 'chartData2',
            // 'chartLabels3',
            // 'chartData3',
            // 'dynamicArchivePercentage',
            // 'staticArchivePercentage',
            // 'permanentArchivePercentage',
            // 'dynamicActivePercentage',
            // 'dynamicInactivePercentage',
            // 'staticSavedPercentage',
            // 'staticSubmittedPercentage',
            // 'vitalArchivePercentage',
            'savedDynamicArchive',
            'savedStaticArchive',
            'savedPermanentArchive',
            'savedVitalArchive',
            'submittedDynamicArchive',
            'submittedStaticArchive',
            'submittedPermanentArchive',
            'submittedVitalArchive',
            'chartBar1',
            'chartBar2',
            'chartBar3'
        ]));
    }
}
