<?php

namespace App\Http\Controllers;

use App\Exports\ArchiveExport;
use App\Models\Archive;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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

        // Ambil list archive_status yang punya arsip terkait
        $archiveStatusList = Archive::with('archive_status')
            ->whereNotNull('archive_status_id')
            ->get()
            ->pluck('archive_status')
            ->unique('id')
            ->sortByDesc('id')
            ->values();

        // Ambil list lifespan distinct dan order by numeric descending
        $lifespanList = Archive::select('archive_lifespan')
            ->whereNotNull('archive_lifespan')
            ->distinct()
            ->orderByRaw('CAST(archive_lifespan AS UNSIGNED) DESC')
            ->pluck('archive_lifespan');

        return view('apps.archive-report.index', compact('workTeamClassificationList', 'archiveStatusList', 'lifespanList'));
    }

    public function filter(Request $request)
    {
        try {
            $query = Archive::with(['work_team_classification', 'archive_status']);

            $query->when($request->text_search, function ($q) use ($request) {
                $q->where('archive_description', 'like', '%' . $request->text_search . '%');
            });

            $query->when($request->start_date, function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->start_date);
            });

            $query->when($request->end_date, function ($q) use ($request) {
                $q->whereDate('created_at', '<=', $request->end_date);
            });

            $query->when($request->archive_status, function ($q) use ($request) {
                // Filter by archive_status_id, which is sent as an ID from select option
                $q->where('archive_status_id', $request->archive_status);
            });

            $query->when($request->classification, function ($q) use ($request) {
                // Filter by work_team_classification_id
                $q->where('work_team_classification_id', $request->classification);
            });

            $query->when($request->lifespan, function ($q) use ($request) {
                $q->where('archive_lifespan', $request->lifespan);
            })->orderByDesc('archive_lifespan');

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
                ->addColumn('status', function ($row) {
                    return optional($row->archive_status)->name ?? '-';
                })
                ->rawColumns(['classification_code', 'description', 'lifespan', 'status'])
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
        $filters = $request->only([
            'text_search',
            'start_date',
            'end_date',
            'archive_status',
            'classification',
            'lifespan',
        ]);

        return Excel::download(new ArchiveExport($filters), 'Laporan-Arsip.xlsx');
    }

    public function generatePdf(Request $request)
    {
        Log::info('Menggunakan Snappy untuk generate PDF');
        Log::info('Memulai generate PDF dengan filter:', $request->all());

        $filters = $request->only([
            'text_search',
            'start_date',
            'end_date',
            'archive_status',
            'classification',
            'lifespan',
        ]);

        // Ubah 'null' string jadi null beneran
        $filters = array_map(function ($v) {
            return $v === 'null' ? null : $v;
        }, $filters);

        $hash = md5(json_encode($filters));
        $filename = "laporan-arsip-$hash.pdf";
        $path = "pdf_cache/$filename";

        // Buat folder jika belum ada
        if (!Storage::exists('pdf_cache')) {
            Log::info('Folder pdf_cache tidak ada, membuat...');
            Storage::makeDirectory('pdf_cache');
        }

        try {
            if (!Storage::exists($path)) {
                $query = Archive::with([
                    'work_team_classification',
                    'archive_status',
                    'building',
                    'cabinet',
                    'shelf',
                    'shelf_row',
                    'folder'
                ]);

                // FILTER QUERY
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

                Log::info('Jumlah arsip:', ['count' => $archives->count()]);

                $pdf = SnappyPdf::loadView('apps.archive-report.exportPDF', compact('archives'))
                        ->setPaper('A4', 'landscape');

                $result = Storage::put($path, $pdf->output());

                Log::info('Hasil simpan PDF: ' . ($result ? 'Berhasil' : 'Gagal'));
            } else {
                Log::info('File sudah ada: ' . $path);
            }

            return response()->file(storage_path("app/$path"), [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '"'
            ]);

        } catch (\Throwable $e) {
            Log::error("Gagal generate PDF: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            abort(500, 'Terjadi kesalahan saat generate PDF.');
        }
    }

    public function showLoadingPdf(Request $request)
    {
        // Kirim semua parameter ke view
        return view('apps.archive-report.loadingPDF', [
            'params' => $request->query()
        ]);
    }

}
