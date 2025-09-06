<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CountVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        // Simpan IP unik
        DB::table('visitors')->updateOrInsert(
            ['ip' => $ip],
            ['updated_at' => now(), 'created_at' => now()]
        );

        
        return $next($request);
    }
}
