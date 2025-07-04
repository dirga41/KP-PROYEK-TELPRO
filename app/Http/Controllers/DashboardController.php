<?php

namespace App\Http\Controllers;

use App\Models\Project; // <-- Tambahkan ini untuk mengimpor model Project
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

        if ($loginType === 'project') {
            // Ambil semua data proyek dari database, diurutkan dari yang terbaru
            $projects = Project::latest()->get();

            // Memuat view khusus untuk project dan mengirimkan data proyek
            return view('dashboards.project', [
                'user' => $user,
                'projects' => $projects, // <-- Kirim data proyek ke view
            ]);
        } 
        
        if ($loginType === 'marketing') {
            // Logika untuk dashboard marketing (jika diperlukan)
            return view('dashboards.marketing', ['user' => $user]);
        }

        return abort(403, 'Tipe akun tidak valid.');
    }
}
