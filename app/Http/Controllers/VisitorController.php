<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

class VisitorController extends Controller
{
    /**
     * Halaman utama monitoring visitor & user online.
     */
    public function index()
    {
        return view('apps.monitoring.index');
    }

    public function track(Request $request)
    {
        try {
            $userAgent = $request->header('User-Agent') ?? 'Unknown';
            $agent = new Agent();
            $agent->setUserAgent($userAgent);

            $ip = $request->ip();

            // Cek apakah IP ini sudah tercatat hari ini
            $exists = Visitor::where('ip', $ip)
                ->whereDate('created_at', today())
                ->exists();

            if (!$exists) {
                Visitor::create([
                    'ip' => $ip,
                    'user_agent' => $userAgent,
                    'device' => $agent->deviceType() ?? 'Unknown',
                    'browser' => $agent->browser() ?? 'Unknown',
                ]);
            }

            return response()->json(['status' => 'tracked']);
        } catch (\Exception $e) {
            Log::error('Visitor Track Error: '.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Ambil jumlah total visitor
    public function count()
    {
        $count = Visitor::count();
        return response()->json(['total' => $count]);
    }

    // Ambil visitor Harian
    public function today()
    {
        $count = Visitor::whereDate('created_at', now()->toDateString())->count();
        return response()->json(['today' => $count]);
    }

    // Ambil visitor Minggu ini
    public function weekly()
    {
        $count = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        return response()->json(['weekly' => $count]);
    }

    // Ambil visitor Bulan ini
    public function monthly()
    {
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();

        $count = Visitor::whereBetween('created_at', [$start, $end])->count();

        return response()->json(['monthly' => $count]);
    }


    // Ambil pengunjung terbaru
    public function latest()
    {
        return datatables()
        ->of(Visitor::with('user')->orderBy('created_at', 'desc'))
        ->addIndexColumn()
        ->addColumn('name', fn($v) => $v->user->name ?? 'Guest')
        ->addColumn('browser', fn($v) => $v->browser ?? '-')
        ->addColumn('device', fn($v) => $v->device ?? '-')
        ->addColumn('created_at', fn($v) => $v->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s'))
        ->rawColumns(['name', 'browser', 'device', 'created_at'])
        ->make(true);
    }


    // Ambil data pengunjung 7 hari terakhir untuk chart
    public function chart()
    {
        $data = [];
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $labels[] = now()->subDays($i)->format('d M');
            $data[] = Visitor::whereDate('created_at', $date)->count();
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
