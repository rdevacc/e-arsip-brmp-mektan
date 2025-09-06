<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    // Simpan pengunjung baru
    public function track(Request $request)
    {
        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');

        // Cek apakah sudah ada hari ini
        $exists = Visitor::where('ip', $ip)
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if (!$exists) {
            Visitor::create([
                'ip' => $ip,
                'user_agent' => $userAgent,
            ]);
        }

        return response()->json(['status' => 'tracked']);
    }

    // Ambil jumlah total visitor
    public function count()
    {
        $count = Visitor::count();
        return response()->json(['total' => $count]);
    }

    // Ambil visitor harian
    public function today()
    {
        $count = Visitor::whereDate('created_at', now()->toDateString())->count();
        return response()->json(['today' => $count]);
    }
}
