<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MonitoringUserController extends Controller
{
    public function index() 
    {
        return view('apps.monitoring.users.index');
    }

    // Data untuk DataTables
    public function getData()
    {
        $users = User::with('logins')->get(); // ambil semua user

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('name', fn($user) => $user->name)
            ->addColumn('email', fn($user) => $user->email)
            ->addColumn('last_login', function($user) {
                $lastLogin = $user->logins->sortByDesc('logged_in_at')->first();
                return $lastLogin ? $lastLogin->logged_in_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') : '-';
            })
            ->addColumn('status', function($user) {
                $lastLogin = $user->logins->sortByDesc('logged_in_at')->first();
                
                // Jika user belum pernah login
                if (!$lastLogin) return 'Offline';

                // Status Online: last_seen <= 5 menit & belum logout
                $isOnline = (!$lastLogin->logged_out_at) 
                        && $user->last_seen 
                        && $user->last_seen->diffInMinutes(now()) <= 5;

                return $isOnline ? 'Online' : 'Offline';
            })
            ->make(true);
        }
}
