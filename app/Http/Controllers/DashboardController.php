<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the correct dashboard based on the user's guard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $activeGuard = null;

        foreach (['marketing', 'project', 'web'] as $guard) {
            if (Auth::guard($guard)->check()) {
                $activeGuard = $guard;
                break;
            }
        }
        
        $loginType = $activeGuard ?? 'unknown';

        // --- Logika untuk memilih view ---
        if ($loginType === 'marketing') {
            // Memuat view khusus untuk marketing
            return view('dashboards.marketing', [
                'user' => $user,
            ]);

        } elseif ($loginType === 'project') {
            
            // Memuat view khusus untuk project
            return view('dashboards.project', [
                'user' => $user,
            ]);
        }

        // Fallback jika tipe login tidak diketahui
        return abort(403, 'Tipe akun tidak valid.');
    }
}
