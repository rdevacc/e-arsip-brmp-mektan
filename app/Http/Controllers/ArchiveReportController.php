<?php

namespace App\Http\Controllers;

use App\Exports\ArchiveExport;
use App\Models\Archive;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ArchiveReportController extends Controller
{
    public function index()
    {
        // Ambil list work_team_classification yang punya arsip terkait
        $workTeamClassificationList = Archive::with('work_team_classification')
            ->whereNotNull('work_team_classification_id')
            ->get()
            ->pluck('work_team_classification')
            ->unique('id')
            ->sortByDesc('id')
            ->values();

        // Ambil list archive_type yang punya arsip terkait
        $archiveTypeList = Archive::with('archive_type')
            ->whereNotNull('archive_type_id')
            ->get()
            ->pluck('archive_type')
            ->unique('id')
            ->sortByDesc('id')
            ->values();

        // Ambil list archive_type yang punya arsip terkait
        $archiveSubTypeList = Archive::with('archive_subtype')
            ->whereNotNull('archive_subtype_id')
            ->get()
            ->pluck('archive_subtype')
            ->unique('id')
            ->sortByDesc('id')
            ->values();

        // Ambil list archive_status yang punya arsip terkait
        $archiveStatusList = Archive::with('archive_status')
            ->whereNotNull('archive_status_id')
            ->get()
            ->pluck('archive_status')
            ->unique('id')
            ->sortByDesc('id')
            ->values();

        // Ambil list period distinct dan order by numeric descending
        $periodList = Archive::with('period')
            ->whereNotNull('period_id')
            ->get()
            ->pluck('period')
            ->unique('id')
            ->sortByDesc('id')
            ->values();

        // Ambil list year_period distinct dan order by numeric descending
        $yearPeriodList = Archive::select('year_period')
            ->whereNotNull('year_period')
            ->distinct()
            ->orderByRaw('CAST(year_period AS UNSIGNED) DESC')
            ->pluck('year_period');

        // Ambil list lifespan distinct dan order by numeric descending
        $lifespanList = Archive::select('archive_lifespan')
            ->whereNotNull('archive_lifespan')
            ->distinct()
            ->orderByRaw('CAST(archive_lifespan AS UNSIGNED) DESC')
            ->pluck('archive_lifespan');

        return view('apps.archive-report.index', compact('workTeamClassificationList', 'archiveTypeList', 'archiveSubTypeList',  'archiveStatusList', 'lifespanList', 'periodList', 'yearPeriodList'));
    }

    public function filter(Request $request)
    {
        try {
            $query = Archive::with(['work_team_classification', 'archive_status', 'archive_type', 'archive_subtype', 'period']);

            $query->when($request->text_search, function ($q) use ($request) {
                $q->where('archive_description', 'like', '%' . $request->text_search . '%');
            });

            $query->when($request->start_date, function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->start_date);
            });

            $query->when($request->end_date, function ($q) use ($request) {
                $q->whereDate('created_at', '<=', $request->end_date);
            });

            $query->when($request->archive_type, function ($q) use ($request) {
                // Filter by archive_type_id, which is sent as an ID from select option
                $q->where('archive_type_id', $request->archive_type);
            });

            $query->when($request->archive_subtype, function ($q) use ($request) {
                // Filter by archive_subtype_id, which is sent as an ID from select option
                $q->where('archive_subtype_id', $request->archive_subtype);
            });

            $query->when($request->archive_status, function ($q) use ($request) {
                // Filter by archive_status_id, which is sent as an ID from select option
                $q->where('archive_status_id', $request->archive_status);
            });
            
            $query->when($request->classification, function ($q) use ($request) {
                // Filter by work_team_classification_id
                $q->where('work_team_classification_id', $request->classification);
            });
            
            $query->when($request->period, function ($q) use ($request) {
                // Filter by archive_period_id, which is sent as an ID from select option
                $q->where('archive_period_id', $request->period);
            });

            $query->when($request->lifespan, function ($q) use ($request) {
                $q->where('archive_lifespan', $request->lifespan);
            })->orderByDesc('archive_lifespan');

            $query->when($request->year_period, function ($q) use ($request) {
                $q->where('year_period', $request->year_period);
            })->orderByDesc('year_period');

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->addColumn('classification_code', function ($row) {
                    return optional($row->work_team_classification)->code ?? '-';
                })
                ->addColumn('description', function ($row) {
                    return $row->archive_description ?? '-';
                })
                ->addColumn('lifespan', function ($row) {
                    return $row->archive_lifespan ?? '-';
                })
                ->addColumn('period', function ($row) {
                    return optional($row->period)->name ?? '-';
                })
                ->addColumn('year_period', function ($row) {
                    return $row->year_period ?? '-';
                })
                ->addColumn('type', function ($row) {
                    return optional($row->archive_type)->name ?? '-';
                })
                ->addColumn('subtype', function ($row) {
                    return optional($row->archive_subtype)->name ?? '-';
                })
                ->addColumn('status', function ($row) {
                    return optional($row->archive_status)->name ?? '-';
                })
                ->rawColumns(['classification_code', 'description', 'lifespan', 'period', 'year_period', 'type', 'subtype', 'status'])
                ->make(true);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

    public function exportExcel(Request $request)
    {
        set_time_limit(300);
        ini_set('memory_limit', '512M');
        
        $filters = $request->only([
            'text_search',
            'start_date',
            'end_date',
            'archive_type',
            'archive_subtype',
            'archive_status',
            'classification',
            'lifespan',
            'period',
            'year_period',
        ]);

        $hasFilters = !empty(array_filter($filters, function($value) {
            return !is_null($value) && $value !== '';
        }));

        if ($hasFilters) {
            return Excel::download(new ArchiveExport($filters), 'Laporan-Arsip.xlsx');
        } else {
            return Excel::download(new ArchiveExport(), 'Laporan-Arsip.xlsx');
        }
    }

    public function generatePdf(Request $request)
    {
        Log::info('Menggunakan Redis untuk cache PDF');

        $filters = $request->only([
            'text_search', 'start_date', 'end_date',
            'archive_status', 'classification', 'lifespan',
        ]);

        $filters = array_map(fn($v) => $v === 'null' ? null : $v, $filters);

        $filters['last_updated'] = optional(Archive::max('updated_at'))->timestamp ?? now()->timestamp;

        $cacheKey = 'pdf:' . md5(json_encode($filters));

        if (Cache::has($cacheKey)) {
            Log::info("File PDF ditemukan di Redis cache: $cacheKey");
            $pdfContent = Cache::get($cacheKey);

            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="laporan-arsip.pdf"');
        }

        // Jika tidak ada cache, ambil data dari database
        $query = Archive::with([
            'work_team_classification',
            'archive_status',
            'building', 'cabinet', 'shelf',
            'shelf_row', 'folder'
        ]);

        if (!empty($filters['text_search'])) {
            $query->where('archive_description', 'like', '%' . $filters['text_search'] . '%');
        }
        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }
        if (!empty($filters['archive_status'])) {
            $query->where('archive_status_id', $filters['archive_status']);
        }
        if (!empty($filters['classification'])) {
            $query->where('work_team_classification_id', $filters['classification']);
        }
        if (isset($filters['lifespan']) && $filters['lifespan'] !== null) {
            $query->where('archive_lifespan', $filters['lifespan']);
        }

        $archives = $query->get();
        Log::info('Jumlah arsip diambil:', ['count' => $archives->count()]);

        $pdf = SnappyPdf::loadView('apps.archive-report.exportPDF', compact('archives'))
            ->setPaper('A4', 'landscape');

        $pdfContent = $pdf->output();

        Cache::put($cacheKey, $pdfContent, now()->addHours(1));
        Log::info("PDF baru disimpan ke Redis cache: $cacheKey");

        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="laporan-arsip.pdf"');
    }
}
